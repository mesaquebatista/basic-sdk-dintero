<?php

namespace BasicSdkDintero\Client\Session;

use BasicSdkDintero\Client\Auth\AuthClient;
use BasicSdkDintero\Client\DinteroClient;
use BasicSdkDintero\Client\Session\SessionClientInterface;
use BasicSdkDintero\DinteroConfig;
use BasicSdkDintero\Exceptions\DinteroApiException;
use BasicSdkDintero\Exceptions\InvalidDataException;
use BasicSdkDintero\Models\Response;

final class SessionClient extends DinteroClient implements SessionClientInterface
{
    private const URL_SEARCH = "/sessions";
    private const URL_CREATE = "/sessions-profile";
    private $authClient;

    public function __construct(AuthClient $authClient, array $config = [])
    {
        parent::__construct($config);
        $this->authClient = $authClient;
    }

    /**
     * Generate a new session with the Dintero API.
     *
     * @param array
     * @return Response
     */
    public function generateSession($data = []): Response
    {
        $response = $this->verifyDataCreateSession($data);
        if ($response) throw new InvalidDataException($response);

        $auth = $this->authClient->generateToken();
        if ($auth->error) throw new DinteroApiException('The API request was unsuccessful. RESPONSE: ' . json_encode($auth));

        if (!isset($data['order']['currency'])) $data['order']['currency'] = DinteroConfig::$CURRENCY;

        return parent::post(DinteroConfig::$BASE_URL . self::URL_CREATE, $data, [
            'Authorization' => $auth->success->token_type . ' ' . $auth->success->access_token,
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Get transaction details with Dintero API.
     *
     * @param string
     * @return Response
     */
    public function getSession($session_id): Response
    {
        $auth = $this->authClient->generateToken();
        if ($auth->error) throw new DinteroApiException('The API request was unsuccessful. RESPONSE: ' . json_encode($auth));

        return parent::get(DinteroConfig::$BASE_URL . self::URL_SEARCH . '/' . $session_id, [], [
            'Authorization' => $auth->success->token_type . ' ' . $auth->success->access_token,
            'Content-Type' => 'application/json',
        ]);
    }

    private function verifyDataCreateSession($data)
    {
        $response = null;
        if (!isset($data['url']) || !isset($data['url']['return_url']) || !isset($data['url']['return_url'])) {
            $response = 'Please verify the mandatory parameters of the URL and try again';
        } else if (!isset($data['order']) || !isset($data['order']['amount'])) {
            $response = 'Please verify the mandatory parameters of the \'order\' and try again';
        } else if (!isset($data['profile_id'])) {
            $response = 'Please verify the mandatory parameter \'profile_id\' and try again.';
        }

        return $response;
    }
}
