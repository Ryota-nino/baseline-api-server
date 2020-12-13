<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('frigana'); # フリガナ
            $table->string('company_name'); # 企業名
            $table->text('business_description'); # 事業内容
            $table->bigInteger('number_of_employees'); # 従業員数
            $table->string('logo_path')->nullable(); # ロゴのパス
            $table->string('company_url'); # URL
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
        Schema::dropIfExists('companies');
    }
}
