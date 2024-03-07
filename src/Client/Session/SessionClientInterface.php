<?php

namespace BasicSdkDintero\Client\Session;

use BasicSdkDintero\Models\Response;

interface SessionClientInterface
{
    public function generateSession(): Response;
    public function getSession($session_id): Response;
}