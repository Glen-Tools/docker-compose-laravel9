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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->timestamp('password_update_time')->nullable();
            $table->boolean('status')->comment("狀態(開,關)")->default(1);
            $table->smallInteger('user_type')->comment("管理者=1,一般使用者=2");
            $table->string('login_ip', 20)->nullable();
            $table->timestamp('login_time')->nullable();
            $table->string('remark', 5000)->nullable()->comment("備註");
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
};
