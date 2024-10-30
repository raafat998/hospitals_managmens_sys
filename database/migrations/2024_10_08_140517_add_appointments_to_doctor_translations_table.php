<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('doctor_translations', function (Blueprint $table) {
            $table->string('appointments')->nullable(); // أو يمكنك تحديد نوع البيانات المناسب
        });
    }
    
    public function down()
    {
        Schema::table('doctor_translations', function (Blueprint $table) {
            $table->dropColumn('appointments');
        });
    }
    
};
