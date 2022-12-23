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

  //信件說明
  'validation_view' => 'zh_tw.email.validation',
  'validation_code' => '保留 :expireTime 分鐘，請於時間內完成',
  'register_in' => [
    'subject' => '您好，註冊：:app_name 帳號，請認證後完成後續動作。',
    'title' => '註冊：:app_name，:account',
    'page_content' => '驗證碼 :code '
  ],
  'fogot_password' => [
    'subject' => '您好，重置 :app_name 密碼，請填入認證碼後修改。',
    'title' => ':app_name 重置密碼帳號 :account ',
    'page_content' => '驗證碼 :code '
  ],
];
