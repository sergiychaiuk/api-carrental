<?php

namespace App;

use Core\Database;
use Core\Header;

class App
{
    static public function init()
    {
        Header::headers();

        Database::connect();

        require_once $_SERVER['DOCUMENT_ROOT'] . '/routes/api.php';

        Database::disconnect();
    }
}
