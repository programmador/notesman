<?php

use App\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration
{

    public function up()
    {
        $this->schema->create('tasks', function(Blueprint $table){
            $table->increments('id');
            $table->text('description');
            $table->binary('image')->nullable();

            $table->integer('user_id')->unsigned();

            $table->index('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        $this->schema->drop('tasks');
    }

}
