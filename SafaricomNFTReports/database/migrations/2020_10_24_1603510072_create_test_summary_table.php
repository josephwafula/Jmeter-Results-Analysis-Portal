<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestSummaryTable extends Migration
{
    public function up()
    {
        Schema::create('test_summary', function (Blueprint $table) {

		$table->integer('summary_id',50);
		$table->string('project_id',50);
		$table->string('run_type_id',50);
		$table->string('endpoint', 50);
		$table->string('AVG_TPS',50);
		$table->string('AVG_response_time',50);
		$table->string('error_rate',50);
		$table->string('createdby',50);
		$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('test_summary');
    }
}