<?php

use App\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    public function up()
    {
        $this->schema->create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->text('name');
            $table->boolean('is_admin')->default(false);
            $table->string('password')->default('');
            $table->string('salt')->default('');

            $table->unique('email');
        });
    }

    public function down()
    {
        $this->schema->drop('users');
    }

}
