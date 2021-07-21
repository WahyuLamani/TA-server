<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distributor_id');
            $table->foreignId('company_id')->nullable();
            $table->foreignId('product_type_id')->nullable();
            $table->integer('req_amount');
            $table->enum('on_progress', ['Waiting', 'Accepted', 'Clear'])->default('Waiting');
            $table->foreignId('agent_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
