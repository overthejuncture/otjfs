<?php

namespace Core;

use Core\Database\DB;

abstract class Migration
{
    public function __construct()
    {
    }

    abstract public function up();

    abstract public function down();
}
