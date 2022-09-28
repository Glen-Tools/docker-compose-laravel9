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
        Schema::create('log', function (Blueprint $table) {
            $table->id();
            $table->string("feature", 100)->nullable()->comment("功能名稱");
            $table->string("operate", 100)->nullable()->comment("操作");
            $table->string("table", 100)->nullable()->comment("table");
            $table->bigInteger("user_id")->comment("操作人id");
            $table->string("content");
            $table->timestamp("create_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log');
    }
};
