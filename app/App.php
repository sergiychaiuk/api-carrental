<?php

namespace App;

use Core\Database;

class App
{
    static public function init()
    {
        Database::connect();

        require_once $_SERVER['DOCUMENT_ROOT'] . '/routes/api.php';

        Database::disconnect();
    }
}
