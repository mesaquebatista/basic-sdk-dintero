## 🌟 Primeiros passos para o uso da biblioteca

O uso simples de criar pagamento é mais ou menos assim:

```php
<?php
    // Passo 1: Importar classes necessárias
    use Src\Dintero\Client\Auth\AuthClient;
    use Src\Dintero\Client\Session\SessionClient;
    use Src\Dintero\DinteroConfig;

    // Passo 2: Configurar ambiente Dintero
    DinteroConfig::setAccountId("<account_id>");
    DinteroConfig::setClientId("<client_id>");
    DinteroConfig::setClientSecret("<client_secret>");
    DinteroConfig::setClientAudience("<client_audience>");

    // Passo 3: Criar sessão
    $auth = new AuthClient();
    $session = new SessionClient($auth); 
    $result = $session->generateSession([
        "url" => [
            "return_url" => "https://example.com/thankyou",
            "callback_url" => "https://example.com/callback"
        ],
        "order" => [
            "amount" => 220,
            "currency" => "NOK",
            "merchant_reference" => "123456"
        ],
        "profile_id" => "T99999999.abcdef123456789ghijklm"
    ]);
```

O uso simples de pegar pagamento é mais ou menos assim:

```php
<?php
    // Passo 1: Importar classes necessárias
    use Src\Dintero\Client\Auth\AuthClient;
    use Src\Dintero\Client\Session\SessionClient;
    use Src\Dintero\DinteroConfig;

    // Passo 2: Configurar ambiente Dintero
    DinteroConfig::setAccountId("<account_id>");
    DinteroConfig::setClientId("<client_id>");
    DinteroConfig::setClientSecret("<client_secret>");
    DinteroConfig::setClientAudience("<client_audience>");

    // Passo 3: Pegar sessão
    $auth = new AuthClient();
    $session = new SessionClient($auth); 
    $result = $session->getSession("T99999999.abcdef123456789ghijklm");
```