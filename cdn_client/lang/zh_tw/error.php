<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    //錯誤訊息
    "parameter"                      => "參數錯誤:msg",
    "parameter_login_name_duplicate" => "登入帳號重複",
    "create_login_name_duplicate"    => "帳號重複",
    "unauthorized"                   => "身份驗證錯誤",
    "password"                       => "密碼錯誤",
    "password_update"                => "密碼修改，只限本人",
    "refresh_authorized"             => "刷新身份錯誤",
    "server"                         => "程式錯誤",
    "generate_jwt"                   => "產生 jwt 錯誤",
    "generate_refresh_jwt"           => "產生 Refresh jwt 錯誤",
    "user_authority_insufficinet"    => "使用者權限不足",
    "user_not_found"                 => "找不到使用者",
    "user_has_exsit"                 => "使用者已經存在",
    "validation_code"                => ":type 認證碼錯誤",

    "login"                          => "登入",
    "register_in"                    => "註冊",
    "forgot_password"                => "重置密碼",

    "sql_insert"                     => "SQL語法新增錯誤",
    "sql_update"                     => "SQL語法修改錯誤",
    "sql_delete"                     => "SQL語法刪除錯誤",
    "sql_duplicate_key"              => ": 識別碼(key) 重複,請重新輸入",
    "sql_menu"                       => ": 菜單權限錯誤",
    "not_found"                      => "頁面不存在",
    "not_found_http_method"          => "Http method 錯誤",
    "data_not_found"                 => ":title資料不存在",
    "param_not_number"               => "querystring:{id},(:param) 此參數必須是整數",
];
