<?php

namespace BasicSdkDintero\Client\Transaction;

use BasicSdkDintero\Models\Response;

interface TransactionClientInterface
{
    public function getTransaction($transaction_id): Response;
}