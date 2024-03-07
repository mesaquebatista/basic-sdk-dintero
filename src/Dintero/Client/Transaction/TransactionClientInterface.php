<?php

namespace Src\Dintero\Client\Transaction;

use Src\Dintero\Models\Response;

interface TransactionClientInterface
{
    public function getTransaction($transaction_id): Response;
}