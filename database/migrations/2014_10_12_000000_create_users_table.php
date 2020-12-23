<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->bigInteger('sex')->nullable(); # 性別
            $table->string('icon_image_path')->nullable(); # ユーザーアイコン
            $table->bigInteger('annual')->nullable(); # 年次
            $table->bigInteger('year_of_graduation')->nullable(); # 卒業年次
//            $table->string('activity_stats');
            $table->string('desired_occupations')->nullable(); # 希望職種
            $table->string('privilege')->nullable(); # 権限
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verify_token')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
