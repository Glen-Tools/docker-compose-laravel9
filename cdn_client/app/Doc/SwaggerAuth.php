<?php

namespace App\Doc;

class SwaggerAuth
{
    /**
     * @OA\Examples(
     *   summary="AuthMenuList",
     *   example="AuthMenuList",
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
     *          }
     *        },
     *      },
     *      "message": "",
     *      "success": true
     *    }
     * )
     */
    public $AuthMenuList;
}
