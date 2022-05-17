<?php

namespace Core;

class Header
{
    static public function headers()
    {
        $config = require_once 'config/headers.php';

        foreach ($config as $key => $value) {
            header($key . ': ' . $value);
        }
    }
}
