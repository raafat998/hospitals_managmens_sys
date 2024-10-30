<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDebitToAmountInReceiptAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receipt_accounts', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->nullable()->after('id'); // بعد عمود id أو حسب المكان الذي تريده
            $table->dropColumn('Debit'); // حذف العمود القديم
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receipt_accounts', function (Blueprint $table) {
            $table->decimal('Debit', 8, 2)->nullable()->after('id'); // إعادة العمود القديم
            $table->dropColumn('amount'); // حذف العمود الجديد
        });
    }
}
