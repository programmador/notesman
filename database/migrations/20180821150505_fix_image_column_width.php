<?php

use App\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class FixImageColumnWidth extends Migration
{

    public function up()
    {
        $this->schema->table('tasks', function(Blueprint $table){
            $table->dropColumn('image');
        });
        $this->capsule->getDatabaseManager()->statement("ALTER TABLE tasks ADD image LONGBLOB");
    }

    public function down()
    {
        $this->schema->table('tasks', function(Blueprint $table){
            $table->dropColumn('image');
        });
        $this->schema->table('tasks', function(Blueprint $table){
            $table->binary('image')->nullable();
        });
    }

}
