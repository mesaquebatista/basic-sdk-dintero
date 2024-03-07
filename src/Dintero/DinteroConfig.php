<?php

namespace Src\Dintero;

use Src\Dintero\Configs\Currency;
use Src\Dintero\Configs\Environment;

/**
 * Class DinteroConfig
 *
 * This class provides configuration constants for Dintero API integration.
 */
class DinteroConfig
{
    /**
     * @var string $BASE_URL The base URL for Dintero API.
     */
    public static string $BASE_URL = 'https://checkout.dintero.com/v1';

    /**
     * @var string $CURRENCY The currency to be used in transactions.
     */
    public static string $CURRENCY = Currency::NOK;

    /**
     * @var string $account_id The account ID for Dintero API authentication.
     */
    private static string $account_id = '';

    /**
     * @var string $client_id The client ID for Dintero API authentication.
     */
    private static string $client_id = '';

    /**
     * @var string $client_secret The client secret for Dintero API authentication.
     */
    private static string $client_secret = '';

    /**
     * @var string $client_audience The client audience for Dintero API authentication.
     */
    private static string $client_audience = '';

    /**
     * @var string $environment The Environment for Dintero API integration.
     */
    private static string $environment = Environment::LOCAL;

    /**
     * Retrieve the Dintero account ID.
     *
     * @return string
     */
    public static function getAccountId()
    {
        return self::$account_id;
    }

    /**
     * Retrieve the Dintero account ID with the current environment.
     *
     * @return string
     */
    public static function getAccountIdWithEnvironment()
    {
        return self::$environment . self::$account_id;
    }

    /**
     * Set the Dintero account ID.
     *
     * @param string $account_id The account ID to set.
     */
    public static function setAccountId($account_id)
    {
        self::$account_id = $account_id;
    }

    /**
     * Retrieve the Dintero client ID.
     *
     * @return string
     */
    public static function getClientId()
    {
        return self::$client_id;
    }

    /**
     * Set the Dintero client ID.
     *
     * @param string $client_id The client ID to set.
     */
    public static function setClientId($client_id)
    {
        self::$client_id = $client_id;
    }

    /**
     * Retrieve the Dintero client secret.
     *
     * @return string
     */
    public static function getClientSecret()
    {
        return self::$client_secret;
    }

    /**
     * Set the Dintero client secret.
     *
     * @param string $client_secret The client secret to set.
     */
    public static function setClientSecret($client_secret)
    {
        self::$client_secret = $client_secret;
    }

    /**
     * Retrieve the Dintero client audience.
     *
     * @return string
     */
    public static function getClientAudience()
    {
        return self::$client_audience;
    }

    /**
     * Set the Dintero client audience.
     *
     * @param string $client_audience The client audience to set.
     */
    public static function setClientAudience($client_audience)
    {
        self::$client_audience = $client_audience;
    }

    /**
     * Retrieve the current environment setting.
     *
     * @return string
     */
    public static function getEnvironment()
    {
        return self::$environment;
    }

    /**
     * Set the environment for Dintero API interaction.
     *
     * @param string $environment The environment to set.
     */
    public static function setEnvironment($environment)
    {
        self::$environment = $environment;
    }
}
