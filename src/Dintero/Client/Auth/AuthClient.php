<?php

namespace Src\Dintero\Client\Auth;

use Src\Dintero\Client\DinteroClient;
use Src\Dintero\DinteroConfig;
use Src\Dintero\Models\Response;

final class AuthClient extends DinteroClient implements AuthClientInterface
{
    private const URL = "/accounts";

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * Generate a new Token Auth with Dintero API
     * 
     * @return Response
     */
    public function generateToken(): Response
    {
        return parent::post(DinteroConfig::$BASE_URL . self::URL . '/' . DinteroConfig::getAccountIdWithEnvironment() . '/auth/token', [
            "grant_type" => "client_credentials",
            "audience" => DinteroConfig::getClientAudience()
        ], [
            'Authorization' => self::generateBasicAuth(DinteroConfig::getClientId(), DinteroConfig::getClientSecret()),
            'Content-Type' => 'application/json',
        ]);
    }

    private static function generateBasicAuth($client_id, $client_secret)
    {
        // Concatenate username and password with a colon
        $credentials = $client_id . ':' . $client_secret;

        // Base64 encode the credentials
        $encodedCredentials = base64_encode($credentials);

        // Set the Authorization header with the encoded credentials
        return 'Basic ' . $encodedCredentials;
    }
}
