<?php

namespace Core;

use Core\Database\DB;

abstract class Migration
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = DB::getConnection();
    }

    public function up()
    {

    }

    public function down()
    {

    }
}
