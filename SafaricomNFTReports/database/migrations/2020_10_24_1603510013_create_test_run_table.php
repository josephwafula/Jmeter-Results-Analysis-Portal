<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestRunTable extends Migration
{
    public function up()
    {
        Schema::create('test_run', function (Blueprint $table) {
		$table->integer('run_id',50);
		$table->string('run_type_id',50);
		$table->string('timeStamp',50);
		$table->string('elapsed',50);
		$table->string('label', 50);
		$table->string('responsecode',50);
		$table->string('responsemessage',200);
		$table->string('threadname', 200);
		$table->string('datatype', 50);
		$table->string('success',50);
		$table->string('failuremessage', 200);
		$table->string('bytes',50);
		$table->string('sentbytes',50);
		$table->string('grpthreads',50);
		$table->string('allthreads',50);
		$table->string('URL',200);
		$table->string('latency',50);
		$table->string('idletime',50);
		$table->string('connect',50);
		$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('test_run');
    }
}