<?php

namespace Src\Dintero\Client\Auth;

use Src\Dintero\Models\Response;

interface AuthClientInterface
{
    public function generateToken(): Response;
}