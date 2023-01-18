<?php

namespace App\Providers;

use App\Services\CaptchaService;
use \Mews\Captcha\CaptchaServiceProvider as CaptchaProvider;

class CaptchaServiceProvider extends CaptchaProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        // Merge configs
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/captcha.php',
            'captcha'
        );

        // Bind captcha
        $this->app->bind('CaptchaService', function ($app) {
            return new CaptchaService(
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Illuminate\Contracts\Config\Repository'],
                $app['Intervention\Image\ImageManager'],
                $app['Illuminate\Session\Store'],
                $app['Illuminate\Hashing\BcryptHasher'],
                $app['Illuminate\Support\Str']
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }
}
