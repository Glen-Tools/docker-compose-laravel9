<?php

namespace App\Enums;

//  讀取資料 Enum
enum JwtType: string
{
    case jwtToken = 'token';
    case jwtRefreshToken = 'refreshToken';
}
