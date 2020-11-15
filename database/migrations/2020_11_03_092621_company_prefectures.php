<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyPrefectures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_prefectures', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('prefecture_id')->unsigned();
            
            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnDelete();
            $table->foreign('prefecture_id')->references('id')->on('prefectures')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_prefectures');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('prefectures');
    }
}
