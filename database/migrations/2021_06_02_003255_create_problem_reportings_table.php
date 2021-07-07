<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemReportingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_reportings', function (Blueprint $table) {
            $table->id();
            $table->string('userable_type')->nullable();
            $table->integer('userable_id')->nullable();
            $table->text('post');
            $table->string('pict')->nullable();
            $table->timestamp('added_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem_reportings');
    }
}
