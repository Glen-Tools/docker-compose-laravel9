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
  'validation_view' => 'en.email.validation',
  'validation_code' => 'exist for :expireTime minutes',
  'register_in' => [
    'subject' => 'Hello, Register in :app_name, please fill in the verification code and finish it',
    'title' => 'Register in :account account',
    'page_content' => 'validation code :code ',
  ],
  'fogot_password' => [
    'subject' => 'Hello, reset :app_name website password, please fill in the verification code and modify it',
    'title' => 'Reset password :account password',
    'page_content' => 'validation code :code ',
  ],
];
