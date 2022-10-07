<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        //add admin user and authorization
        //user initial
        DB::table('users')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => '$2y$12$SRrP6I/AC4maB7dRGVa4SuSxuE4WUFozxuFbHJf68lDBmAVzjMpl2',
                    'status' => 1,      //狀態(開,關)
                    'user_type' => 1    //管理者=1,一般使用者=2]
                ],
                [
                    'id' => 2,
                    'name' => 'user',
                    'email' => 'user@gmail.com',
                    'password' => '$2y$12$6f6HMmYcqpmGA/fmrBKjNe05mC0mWd5uZT.WOYA1aulxM7ZmS6hzC',
                    'status' => 1,      //狀態(開,關)
                    'user_type' => 2    //管理者=1,一般使用者=2]
                ]
            ]
        );

        //roles initial
        DB::table('roles')->insert(
            [
                [
                    'id' => 1,
                    "name" => "管理者權限",
                    "key" => "admin",
                    "status" => 1, //"狀態(開,關)"
                    "weight" => 99, //"權重(優先順序 重=高)"
                ],
                [
                    'id' => 2,
                    "name" => "使用者權限",
                    "key" => "user",
                    "status" => 1, //"狀態(開,關)"
                    "weight" => 98, //"權重(優先順序 重=高)"
                ]
            ]
        );

        //menus initial
        DB::table('menus')->insert(
            [
                [
                    'id' => 1,
                    "name" => "使用者頁面",
                    "key" => "user_list",
                    "url" => "api/v1/user", //網址
                    "feature" => "P", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 99,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 2,
                    "name" => "使用者資訊",
                    "key" => "user_info",
                    "url" => "api/v1/user/{user}", //網址
                    "feature" => "P", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 98,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 3,
                    "name" => "使用者新增",
                    "key" => "user_create",
                    "url" => "api/v1/user", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 97,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 4,
                    "name" => "使用者修改",
                    "key" => "user_update",
                    "url" => "api/v1/user/{user}", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 96,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 5,
                    "name" => "使用者刪除",
                    "key" => "user_delete",
                    "url" => "api/v1/user/{user}", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 95,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 6,
                    "name" => "權限頁面",
                    "key" => "role_list",
                    "url" => "api/v1/role", //網址
                    "feature" => "P", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 94,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 7,
                    "name" => "權限資訊",
                    "key" => "role_info",
                    "url" => "api/v1/role/{role}", //網址
                    "feature" => "P", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 93,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 8,
                    "name" => "權限新增",
                    "key" => "role_create",
                    "url" => "api/v1/role", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 92,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 9,
                    "name" => "權限修改",
                    "key" => "role_update",
                    "url" => "api/v1/role/{role}", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 91,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 10,
                    "name" => "權限刪除",
                    "key" => "role_delete",
                    "url" => "api/v1/role/{role}", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 90,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 11,
                    "name" => "菜單頁面",
                    "key" => "menu_list",
                    "url" => "api/v1/menu", //網址
                    "feature" => "P", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 99,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 12,
                    "name" => "菜單資訊",
                    "key" => "menu_info",
                    "url" => "api/v1/menu/{menu}", //網址
                    "feature" => "P", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 98,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 13,
                    "name" => "菜單新增",
                    "key" => "menu_create",
                    "url" => "api/v1/menu", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 97,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 14,
                    "name" => "菜單修改",
                    "key" => "menu_update",
                    "url" => "api/v1/menu/{menu}", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 96,  //權重(優先順序 重=高)
                ],
                [
                    'id' => 15,
                    "name" => "菜單刪除",
                    "key" => "menu_delete",
                    "url" => "api/v1/menu/{menu}", //網址
                    "feature" => "F", //功能(T=標題、P=頁面、F=按鍵功能)
                    "status" => 1,  //狀態(開,關)
                    "parent" => 0,  //父類(id)
                    "weight" => 95,  //權重(優先順序 重=高)
                ]
            ]
        );

        //roles_users Associative table initial
        DB::table('role_user')->insert(
            [
                [
                    "role_id" => 1,
                    "user_id" => 1
                ],
                [
                    "role_id" => 1,
                    "user_id" => 2
                ],
                [
                    "role_id" => 2,
                    "user_id" => 1
                ],
                [
                    "role_id" => 2,
                    "user_id" => 2
                ],
            ]
        );

        //roles_menus Associative table initial
        DB::table('role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 1
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 2
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 3
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 4
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 5
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 6
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 7
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 8
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 9
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 10
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 11
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 12
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 13
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 14
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 15
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
        //roles_users Associative table delete
        DB::table('role_user')->where("role_id", 1)->delete();
        DB::table('role_user')->where("role_id", 2)->delete();

        //roles_menus Associative table delete
        DB::table('role_menu')->where("role_id", 1)->delete();

        //users delete
        DB::table('users')->where("id", "<=", 2)->delete();

        //roles delete
        DB::table('roles')->where("id", "<=", 2)->delete();

        //menus delete
        DB::table('menus')->where("id", "<=", 15)->delete();
    }
};
