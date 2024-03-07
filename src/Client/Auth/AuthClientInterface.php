<?php

namespace BasicSdkDintero\Client\Auth;

use BasicSdkDintero\Models\Response;

interface AuthClientInterface
{
    public function generateToken(): Response;
}