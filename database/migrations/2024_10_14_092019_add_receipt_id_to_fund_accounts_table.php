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
            $table->foreignId('receipt_id')->nullable()->constrained('receipt_accounts')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('fund_accounts', function (Blueprint $table) {
            $table->dropForeign(['receipt_id']);
            $table->dropColumn('receipt_id');
        });
    }
};
