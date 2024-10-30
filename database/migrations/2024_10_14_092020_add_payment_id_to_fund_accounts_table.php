<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fund_accounts', function (Blueprint $table) {
            $table->foreignId('Payment_id')->nullable()->references('id')->on('payment_accounts')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('fund_accounts', function (Blueprint $table) {
            $table->dropForeign(['Payment_id']);
            $table->dropColumn('Payment_id');
        });
    }
};
