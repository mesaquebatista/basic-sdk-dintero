<?php

namespace Src\Dintero\Client;

use Src\Dintero\Models\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

/** Mercado Pago client class. */
class DinteroClient
{
    protected static $client;

    public function __construct(array $config = [])
    {
        self::$client = new Client($config);
    }

    /**
     * Realiza uma solicitação GET.
     *
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return mixed
     * @throws GuzzleException
     */
    protected static function get(string $url, array $params = [], array $headers = [])
    {
        return self::request('GET', $url, ['query' => $params, 'headers' => $headers]);
    }

    /**
     * Realiza uma solicitação POST.
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return mixed
     * @throws GuzzleException
     */
    protected static function post(string $url, array $data = [], array $headers = []): Response
    {
        // Verifica se os dados devem ser enviados como application/json
        if (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/json') {
            return self::request('POST', $url, ['json' => $data, 'headers' => $headers]);
        } else {
            // Caso contrário, envia os dados como application/x-www-form-urlencoded
            return self::request('POST', $url, ['form_params' => $data, 'headers' => $headers]);
        }
    }

    /**
     * Realiza uma solicitação HTTP.
     *
     * @param string $method
     * @param string $url
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public static function request(string $method, string $url, array $options = []): Response
    {
        $responseModel = new Response();
        try {
            $response = self::$client->request($method, $url, $options);
            $responseModel->success = self::parseResponse($response);
            return $responseModel;
        } catch (RequestException $exception) {
            // Tratar exceção de solicitação
            $responseModel->error = json_decode($exception->getResponse()->getBody()->getContents())->error;
            $responseModel->httpCode = $exception->getCode();
            return $responseModel;
        }
    }

    /**
     * Parseia a resposta HTTP.
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    protected static function parseResponse(ResponseInterface $response)
    {
        $contentType = $response->getHeaderLine('Content-Type');
        if (strpos($contentType, 'application/json') !== false) {
            return json_decode($response->getBody()->getContents());
        }
        return $response->getBody()->getContents();
    }
}
