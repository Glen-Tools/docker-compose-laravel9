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
     *       "name": "管理者",
     *       "key": "!QAZ2wsx",
     *       "status": 1,
     *       "weight": null,
     *       "createdAt": "2022-10-05T09:24:37.000000Z",
     *       "updatedAt": "2022-10-05T09:24:37.000000Z"
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
     *              "name": "管理者",
     *              "key": "!QAZ2wsx",
     *              "status": 1,
     *              "weight": null,
     *              "createdAt": "2022-10-05T09:24:37.000000Z",
     *              "updatedAt": "2022-10-05T09:24:37.000000Z"
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
     *          example="管理者"
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
     *          property="weight",
     *          description="weight",
     *          type="string",
     *          example="",
     *      ),
     *      @OA\Property(
     *          property="remark",
     *          description="remark",
     *          type="string",
     *          example="",
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
     *          example="管理者"
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
     *          property="weight",
     *          description="weight",
     *          type="string",
     *          example="",
     *      ),
     *      @OA\Property(
     *          property="remark",
     *          description="remark",
     *          type="string",
     *          example="",
     *      ),
     * )
     */
    public $UpdateRole;
}
