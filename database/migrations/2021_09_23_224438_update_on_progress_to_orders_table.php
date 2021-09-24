<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOnProgressToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('orders', 'on_progress')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('on_progress');
            });
        }
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('on_progress', ['Waiting', 'Accepted', 'Rejected', 'Clear'])->after('req_amount')->default('Waiting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('orders', 'on_progress')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('on_progress');
            });
        }
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('on_progress', ['Waiting', 'Accepted', 'Rejected', 'Clear'])->after('req_amount')->default('Waiting');
        });
    }
}
