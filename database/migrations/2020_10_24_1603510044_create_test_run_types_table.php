<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestRunTypesTable extends Migration
{
    public function up()
    {
        Schema::create('test_run_types', function (Blueprint $table) {

		$table->integer('run_type_id',50);
		$table->string('project_id',50);
		$table->string('name',200);
		$table->string('duration',50);
		$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		$table->string('createdby',50);

        });
    }

    public function down()
    {
        Schema::dropIfExists('test_run_types');
    }
}