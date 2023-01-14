<?php

namespace App\Doc;

class SwaggerResponse
{
    /**
     * @OA\Schema(
     *      schema="ResponseSuccess",
     *      @OA\Property(
     *          property="data",
     *          description="data",
     *          type="object",
     *          format="object",
     *          example="null"
     *      ),
     *      @OA\Property(
     *          property="message",
     *          description="message",
     *          type="string",
     *          format="string",
     *          example=""
     *      ),
     *      @OA\Property(
     *          property="success",
     *          description="success",
     *          type="bool",
     *          format="bool",
     *          example="true",
     *      ),
     * )
     */
    public $responseSuccess;

    /**
     * @OA\Schema(
     *      schema="responseError",
     *      @OA\Property(
     *          property="data",
     *          description="data",
     *          type="object",
     *          format="object",
     *          example="null"
     *      ),
     *      @OA\Property(
     *          property="message",
     *          description="message",
     *          type="string",
     *          format="string",
     *          example=""
     *      ),
     *      @OA\Property(
     *          property="success",
     *          description="success",
     *          type="bool",
     *          format="bool",
     *          example="false",
     *      ),
     * )
     */
    public $responseError;

    /**
     * @OA\Schema(
     *      schema="ResponseUnauthorized",
     *      @OA\Property(
     *          property="data",
     *          description="data",
     *          type="object",
     *          format="object",
     *          example="null"
     *      ),
     *      @OA\Property(
     *          property="message",
     *          description="message",
     *          type="string",
     *          format="string",
     *          example="身份驗證錯誤"
     *      ),
     *      @OA\Property(
     *          property="success",
     *          description="success",
     *          type="bool",
     *          format="bool",
     *          example="false",
     *      ),
     * )
     */
    public $responseUnauthorized;
}
