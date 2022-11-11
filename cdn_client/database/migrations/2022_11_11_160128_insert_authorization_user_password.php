<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add user password change auth
        //menus
        DB::table('menus')->insert(
            [
                [
                    'id' => 16,
                    "name" => "使用者密碼修改",
                    "key" => "user_password_update",
                    "url" => "api/v1/user/password/{id}", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 96,  //權重(優先順序 重=高)
                ],
            ]
        );

        //roles_menus  管理者權限=1 ,使用者權限=2
        DB::table('role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 16
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 16
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //roles_menus Associative delete
        DB::table('role_menu')->where("role_id", 1)->where("menu_id", 16)->delete();
        DB::table('role_menu')->where("role_id", 2)->where("menu_id", 16)->delete();

        //menus delete
        DB::table('menus')->where("id", 16)->delete();
    }
};
