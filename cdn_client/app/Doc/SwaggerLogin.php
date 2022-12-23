<?php

namespace App\Doc;

class SwaggerLogin
{
    /**
     * @OA\Examples(
     *   summary="RefreshJwtToken",
     *   example="RefreshJwtToken",
     *   value={
     *     "data": {
     *         "userInfo": {
     *             "id": 1,
     *             "name": "test_update",
     *             "email": "tesq456123wtqwq@gmail.com",
     *             "userType": "1"
     *         },
     *         "authorisation": {
     *             "tokenType": "bearer",
     *             "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJDRE4iLCJleHAiOjE2NjUxMjg3NTAsIm5iZiI6MTY2NTEyMTU1MCwiaWF0IjoxNjY1MTIxNTUwLCJ0b2tlblR5cGUiOiJ0b2tlbiIsImlkIjoxLCJuYW1lIjoidGVzdF91cGRhdGUiLCJlbWFpbCI6InRlc3E0NTYxMjN3dHF3cUBnbWFpbC5jb20iLCJ1c2VyVHlwZSI6IjEifQ.kBgZIOhaUkHBfW5xvWyF062v0saK26cuXP0HLvqXgC4",
     *             "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJDRE4iLCJleHAiOjE2NjUxMzU5NTAsIm5iZiI6MTY2NTEyMTU1MCwiaWF0IjoxNjY1MTIxNTUwLCJ0b2tlblR5cGUiOiJyZWZyZXNoVG9rZW4iLCJpZCI6MSwibmFtZSI6InRlc3RfdXBkYXRlIiwiZW1haWwiOiJ0ZXNxNDU2MTIzd3Rxd3FAZ21haWwuY29tIiwidXNlclR5cGUiOiIxIn0.JcV2W2v3Uz5w1H6On41_g49W7dFI2Ujf7SiNKSEtU0g"
     *         }
     *     },
     *         "message": "",
     *         "success": true
     *     }
     * )
     */
    public $RefreshJwtToken;

    /**
     * @OA\Examples(
     *   summary="LoginOut",
     *   example="LoginOut",
     *   value={
     *         "message": "",
     *         "success": true
     *     }
     * )
     */
    public $LoginOut;

    /**
     * @OA\Schema(
     *      schema="UserLogin",
     *      @OA\Property(
     *          property="account",
     *          description="account",
     *          type="string",
     *          format="string",
     *          example="admin@gmail.com"
     *      ),
     *      @OA\Property(
     *          property="password",
     *          description="password",
     *          type="string",
     *          format="string",
     *          example="admin123"
     *      ),
     * )
     */
    public $UserLogin;

    /**
     * @OA\Schema(
     *      schema="RegisterUser",
     *      @OA\Property(
     *          property="name",
     *          description="name",
     *          type="string",
     *          format="string",
     *          example="gary"
     *      ),
     *      @OA\Property(
     *          property="account",
     *          description="account",
     *          type="string",
     *          format="string",
     *          example="gary@gmail.com"
     *      ),
     *      @OA\Property(
     *          property="password",
     *          description="password",
     *          type="string",
     *          format="string",
     *          example="gary123"
     *      ),
     *      @OA\Property(
     *          property="validation",
     *          description="validation",
     *          type="string",
     *          format="string",
     *          example="hNZK5FAW"
     *      ),
     * )
     */
    public $RegisterUser;

    /**
     * @OA\Schema(
     *      schema="ResetPassword",
     *      @OA\Property(
     *          property="account",
     *          description="account",
     *          type="string",
     *          format="string",
     *          example="gary@gmail.com"
     *      ),
     *      @OA\Property(
     *          property="newPassword",
     *          description="new Passord",
     *          type="string",
     *          format="string",
     *          example="@WSX1qaz"
     *      ),
     *      @OA\Property(
     *          property="checkPassword",
     *          description="check Passord",
     *          type="string",
     *          format="string",
     *          example="@WSX1qaz"
     *      ),
     * )
     */
    public $ResetPassword;
}
