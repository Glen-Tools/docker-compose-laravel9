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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique()->comment("唯一名稱");
            $table->string('key', 150)->unique()->comment("唯一key");
            $table->string('url', 500)->comment("網址");
            $table->string('feature', 10)->comment("功能(T=標題、P=頁面、F=按鍵功能)");
            $table->boolean('status')->comment("狀態(開,關)")->default(1);
            $table->integer('parent')->comment("父類(id)")->default(0);
            $table->smallInteger('weight')->nullable()->comment("權重(優先順序 重=高)");
            $table->string('remark', 5000)->default("")->comment("備註");
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
        Schema::dropIfExists('menus');
    }
};
