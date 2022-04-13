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

    abstract public function up();

    abstract public function down();
}
