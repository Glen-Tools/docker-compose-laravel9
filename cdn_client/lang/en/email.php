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
  'register_in' => [
    'subject' => '【:app_name】Register an account (verification code), please complete the follow-up actions.',
    'page_content' =>
    "<p>You have made a 'register account' request<p/>" .
      "<p>Please enter the following verification code on the registration page<p/>" .
      "<p>verification code : :code<p/>" .
      "<p>**************************************************************<p/>" .
      "<p>caution<p/>" .
      "<p>This confirmation letter will expire :expireTime minutes after the letter is sent,<p/>
       <p>it is recommended that you register as soon as possible<p/>" .
      "<p>**************************************************************<p/>" .
      "<p>This email is sent automatically by the system, please do not reply directly to this email<p/>"
  ],
  'fogot_password' => [
    'subject' => '【:app_name】You have requested to forget / change your password',
    'page_content' =>
    "<p>You have made a 'Forgot Password/Change Password' request <p/>" .
      "<p>Please click the link below and enter a new password<p/>" .
      "<p>If you cannot click the link below, you can copy the URL below to your browser to open and reset your password<p/>" .
      "<p>link:<p/>" .
      "<p>:url<p/>" .
      "<p>**************************************************<p/>" .
      "<p>caution<p/>" .
      "<p>The URL link in this confirmation letter will expire :expireTime minutes after the letter is sent.<p/>
      <p>It is recommended that you set the password as soon as possible.<p/>" .
      "<p>**************************************************<p/>" .
      "<p>This email is sent automatically by the system, please do not reply directly to this email<p/>"
  ],
];
