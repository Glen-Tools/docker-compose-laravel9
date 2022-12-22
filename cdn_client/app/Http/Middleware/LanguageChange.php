<?php

namespace App\Http\Middleware;

use App\Enums\LanguageType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LanguageChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $lang = $request->header('Language');

        //語言包切換
        if (
            isset($lang) &&
            $langValue = LanguageType::getLanguageTypeValueByKey($lang)
        ) {
            App::setLocale($langValue);
        }

        return $next($request);
    }
}
