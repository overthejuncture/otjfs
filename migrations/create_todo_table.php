<?php

use Core\Database\Blueprint;
use Core\Migration;
use Core\Schema;

class create_todo_table extends Migration
{
    /**
     * @throws Exception
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $blueprint) {
            $blueprint->text('body');
        });
    }
}
