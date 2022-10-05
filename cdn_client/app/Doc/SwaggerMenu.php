<?php

namespace App\Doc;

class SwaggerMenu
{
    /**
     * @OA\Examples(
     *   summary="ShowMenuById",
     *   example="ShowMenuById",
     *   value={
     *     "data":{
     *       {
     *       "id": 1,
     *       "name": "ffttttt1",
     *       "key": "gg2222223",
     *       "url": "bbbbb.php",
     *       "feature": "F",
     *       "status": 1,
     *       "parent": 0,
     *       "weight": 1,
     *       "remark": "",
     *       "createdAt": "2022-09-29T08:58:00.000000Z",
     *       "updatedAt": "2022-09-29T08:58:31.000000Z"
     *       }
     *     },
     *     "message": "",
     *     "success": true
     *  }
     * )
     */
    public $ShowMenuById;


    /**
     * @OA\Examples(
     *   summary="ShowMenuList",
     *   example="ShowMenuList",
     *   value={
     *      "data": {
     *        "menuList": {
     *          {
     *              "id": 1,
     *              "name": "ffttttt1",
     *              "key": "gg2222223",
     *              "url": "bbbbb.php",
     *              "feature": "F",
     *              "status": 1,
     *              "parent": 0,
     *              "weight": 1,
     *              "createdAt": "2022-09-29T08:58:00.000000Z",
     *              "updatedAt": "2022-09-29T08:58:31.000000Z"
     *          },
     *          {
     *              "id": 2,
     *              "name": "testbb",
     *              "key": "1234567",
     *              "url": "testbb.php",
     *              "feature": "T",
     *              "status": 1,
     *              "parent": 0,
     *              "weight": 1,
     *              "createdAt": "2022-09-30T09:43:55.000000Z",
     *              "updatedAt": "2022-09-30T09:43:55.000000Z"
     *          }
     *        },
     *        "pageManagement": {
     *            "page": 1,
     *            "pageCount": 1,
     *            "count": 5,
     *            "limit": 10,
     *            "search": {},
     *            "sort": "asc",
     *            "sortColumn": "id"
     *        }
     *      },
     *      "message": "",
     *      "success": true
     *    }
     * )
     */
    public $ShowMenuList;

    /**
     * @OA\Schema(
     *      schema="CreateMenu",
     *      @OA\Property(
     *          property="name",
     *          description="name",
     *          type="string",
     *          format="string",
     *          example="Gary"
     *      ),
     *      @OA\Property(
     *          property="key",
     *          description="key",
     *          type="string",
     *          format="string",
     *          example="!QAZ2wsx"
     *      ),
     *      @OA\Property(
     *          property="url",
     *          description="url",
     *          type="string",
     *          format="string",
     *          example="aa.php"
     *      ),
     *      @OA\Property(
     *          property="feature",
     *          description="feature(T|P|F)",
     *          type="string",
     *          format="string",
     *          example="T",
     *      ),
     *      @OA\Property(
     *          property="status",
     *          description="status",
     *          type="bool",
     *          format="bool",
     *          example="true",
     *      ),
     *      @OA\Property(
     *          property="parent",
     *          description="parent",
     *          type="string",
     *          format="string",
     *          example="0",
     *      ),
     *      @OA\Property(
     *          property="remark",
     *          description="remark",
     *          type="string",
     *          format="string",
     *          example="管理者帳號",
     *      ),
     * )
     */
    public $CreateMenu;

    /**
     * @OA\Schema(
     *      schema="UpdateMenu",
     *      @OA\Property(
     *          property="name",
     *          description="name",
     *          type="string",
     *          format="string",
     *          example="Gary"
     *      ),
     *      @OA\Property(
     *          property="key",
     *          description="key",
     *          type="string",
     *          format="string",
     *          example="!QAZ2wsx"
     *      ),
     *      @OA\Property(
     *          property="url",
     *          description="url",
     *          type="string",
     *          format="string",
     *          example="aa.php"
     *      ),
     *      @OA\Property(
     *          property="feature",
     *          description="feature(T|P|F)",
     *          type="string",
     *          format="string",
     *          example="T",
     *      ),
     *      @OA\Property(
     *          property="status",
     *          description="status",
     *          type="bool",
     *          format="bool",
     *          example="true",
     *      ),
     *      @OA\Property(
     *          property="parent",
     *          description="parent",
     *          type="string",
     *          format="string",
     *          example="0",
     *      ),
     *      @OA\Property(
     *          property="remark",
     *          description="remark",
     *          type="string",
     *          format="string",
     *          example="管理者帳號",
     *      ),
     * )
     */
    public $UpdateMenu;
}
