<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateFyearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fyears', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('recid')->unsigned()->unique();
            $table->string('fyear', 250)->unique();
            $table->string('begdate', 10)->nullable();
            $table->string('enddate', 10)->nullable();
            $table->string('remarks', 250)->nullable();
            $table->string('euser', 150)->nullable();
            $table->date('edate')->nullable();
            $table->time('etime', $precision = 0)->nullable();
            $table->string('uuser', 150)->nullable();
            $table->date('udate')->nullable();
            $table->time('utime', $precision = 0)->nullable();
            $table->bigInteger('llcode')->nullable();
            $table->integer('cmpcode')->nullable();
            $table->integer('isdeleted')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            // $table->integer('timestamps')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fyears');
    }
}
