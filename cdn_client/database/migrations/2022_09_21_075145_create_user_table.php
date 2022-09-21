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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('password_update_time')->nullable();
            $table->boolean('status')->comment("狀態(開,關)");
            $table->integer('user_type')->comment("管理者=1,一般使用者=2");
            $table->string('login_ip')->nullable();
            $table->timestamp('login_time')->nullable();
            $table->integer('remark')->nullable()->comment("備註");
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
        Schema::dropIfExists('user');
    }
};
