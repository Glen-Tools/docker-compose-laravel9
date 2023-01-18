<?php

namespace App\Doc;

class SwaggerCaptcha
{
    /**
     * @OA\Examples(
     *   summary="CreateCaptcha",
     *   example="CreateCaptcha",
     *   value={
     *     "data":{
     *       "captcha": {
     *            "sensitive": false,
     *            "key": "$2y$10$B5NrlMO9nmtZ7/6bPmeLL.RLNszaJKTxlEgWMYC0PKlFzua3FzvRO",
     *            "img": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAe0IAAAAASUVORK5CYII...="
     *         }
     *     },
     *     "message": "",
     *     "success": true
     *  }
     * )
     */
    public $CreateCaptcha;

    /**
     * @OA\Schema(
     *      schema="CheckCaptcha",
     *      @OA\Property(
     *          property="config",
     *          description="config",
     *          type="string",
     *          format="string",
     *          example="default"
     *      ),
     *      @OA\Property(
     *          property="key",
     *          description="key",
     *          type="string",
     *          format="string",
     *          example="$2y$10$B5NrlMO9nmtZ7/6bPmeLL.RLNszaJKTxlEgWMYC0PKlFzua3FzvRO"
     *      ),
     *      @OA\Property(
     *          property="captcha",
     *          description="captcha",
     *          type="string",
     *          format="string",
     *          example="fadsgf"
     *      ),
     * )
     */
    public $CheckCaptcha;
}
