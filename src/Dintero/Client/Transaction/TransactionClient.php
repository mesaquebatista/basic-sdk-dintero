<?php

namespace Src\Dintero\Client\Transaction;

use Src\Dintero\Client\Auth\AuthClient;
use Src\Dintero\Client\DinteroClient;
use Src\Dintero\DinteroConfig;
use Src\Dintero\Exceptions\DinteroApiException;
use Src\Dintero\Models\Response;

final class TransactionClient extends DinteroClient implements TransactionClientInterface
{
    private const URL_SEARCH = "/transactions";
    private $authClient;

    public function __construct(AuthClient $authClient, array $config = [])
    {
        parent::__construct($config);
        $this->authClient = $authClient;
    }

    /**
     * Generate a new transaction with the Dintero API.
     *
     * @param array
     * @return Response
     */
    public function getTransaction($transaction_id): Response
    {
        $auth = $this->authClient->generateToken();
        if ($auth->error) throw new DinteroApiException('The API request was unsuccessful. RESPONSE: ' . json_encode($auth));

        return parent::get(DinteroConfig::$BASE_URL . self::URL_SEARCH . '/' . $transaction_id, [], [
            'Authorization' => $auth->success->token_type . ' ' . $auth->success->access_token,
            'Content-Type' => 'application/json',
        ]);
    }
}
