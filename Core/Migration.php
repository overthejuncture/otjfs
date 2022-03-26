<?php

namespace Core;

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

    protected function down()
    {

    }
}
