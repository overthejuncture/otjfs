<?php

use Core\Database\Blueprint;
use Core\Migration;
use Core\Schema;

class add_done_column_to_todos_table extends Migration
{
    public function up()
    {
        Schema::table('todos', function (Blueprint $blueprint) {
            $blueprint->boolean('done');
        });
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
}
