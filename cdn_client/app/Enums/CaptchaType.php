<?php

namespace App\Enums;

//  驗證碼 Enum
enum CaptchaType: string
{
    case Default = 'default';
    case Math = 'math';
    case Flat = 'flat';
    case Mini = 'mini';
    case Inverse = 'inverse';
}
