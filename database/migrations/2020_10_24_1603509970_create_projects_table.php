<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {

		$table->integer('project_id',11);
		$table->string('project_name',100);
		$table->string('expected_TPS',50);
		$table->string('status',50);
		$table->string('createdby',50);
		$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}