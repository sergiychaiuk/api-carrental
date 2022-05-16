<?php

namespace App;

use Core\Database;

class App
{
    static public function init()
    {
        Database::connect();
        Database::disconnect();
    }
}
