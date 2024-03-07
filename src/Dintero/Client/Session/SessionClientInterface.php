<?php

namespace Src\Dintero\Client\Session;

use Src\Dintero\Models\Response;

interface SessionClientInterface
{
    public function generateSession(): Response;
    public function getSession($session_id): Response;
}