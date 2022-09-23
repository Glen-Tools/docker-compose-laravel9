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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->unique()->comment("唯一名稱");
            $table->string('key',150)->unique()->comment("唯一key");
            $table->boolean('status')->comment("狀態(開,關)")->default(1);
            $table->smallInteger('weight')->comment("權重(優先順序 重=高)");
            $table->string('remark',5000)->nullable()->comment("備註");
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
        Schema::dropIfExists('role');
    }
};
