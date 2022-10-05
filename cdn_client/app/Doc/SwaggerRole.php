<?php

namespace App\Doc;

class SwaggerRole
{
    /**
     * @OA\Examples(
     *   summary="ShowRoleById",
     *   example="ShowRoleById",
     *   value={
     *     "data":{
     *       {
     *       "id": 1,
     *       "name": "ffttttt1",
     *       "key": "gg2222223",
     *       "status": 1,
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
    public $ShowRoleById;


    /**
     * @OA\Examples(
     *   summary="ShowRoleList",
     *   example="ShowRoleList",
     *   value={
     *      "data": {
     *        "roleList": {
     *          {
     *              "id": 1,
     *              "name": "ffttttt1",
     *              "key": "gg2222223",
     *              "status": 1,
     *              "weight": 1,
     *              "createdAt": "2022-09-29T08:58:00.000000Z",
     *              "updatedAt": "2022-09-29T08:58:31.000000Z"
     *          },
     *          {
     *              "id": 2,
     *              "name": "testbb",
     *              "key": "1234567",
     *              "status": 1,
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
    public $ShowRoleList;

    /**
     * @OA\Schema(
     *      schema="CreateRole",
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
     *          property="status",
     *          description="status",
     *          type="bool",
     *          format="bool",
     *          example="true",
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
    public $CreateRole;

    /**
     * @OA\Schema(
     *      schema="UpdateRole",
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
     *          property="status",
     *          description="status",
     *          type="bool",
     *          format="bool",
     *          example="true",
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
    public $UpdateRole;
}
