<?php

namespace App\Enums;

use Illuminate\Support\Str;

//  讀取資料 Enum
enum LanguageType: string
{
    case En = 'en';
    case Tw = 'zh_tw';

    // public static function validLanguageTypeByKey(string $langKey): bool
    // {
    //     $langType = LanguageType::cases();

    //     foreach ($langType  as $key => $value) {
    //         if ($key == $langKey) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    public static function getLanguageTypeValueByKey(string $langKey): string
    {
        $langType = LanguageType::cases();

        foreach ($langType  as $item) {
            if (Str::contains(strtolower($item->name), strtolower($langKey))) {
                return $item->value;
            }
        }
        return "";
    }
}
