<?php

namespace App\Services;

use App\Exceptions\ParameterException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use \Mews\Captcha\Captcha;

class CaptchaService extends Captcha
{
    /**
     * Captcha check
     *
     * @param string $value
     * @param string $key
     * @param string $config
     * @return bool
     */
    public function check_api($value, $key, $config = 'default'): bool
    {
        try {
            if (!Cache::get($this->get_cache_key($key))) {
                throw new ParameterException(trans('error.validation_code', ['type' => trans('error.login')]), Response::HTTP_BAD_REQUEST);
            }

            $this->configure($config);

            if (!$this->sensitive) $value = $this->str->lower($value);
            if ($this->encrypt) $key = Crypt::decrypt($key);

            $check = $this->hasher->check($value, $key);
            if ($check) {
                Cache::forget($this->get_cache_key($key));
            } else {
                throw new ParameterException(trans('error.validation_code', ['type' => trans('error.login')]), Response::HTTP_BAD_REQUEST);
            }
        } catch (\Throwable $th) {
            throw new ParameterException($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $check;
    }
}
