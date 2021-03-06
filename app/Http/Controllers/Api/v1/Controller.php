<?php


namespace App\Http\Controllers\Api\v1;

/**
 * schemas={"http"}
 * @OA\Info(
 *     title="Market API",
 *     version="1.0.0",
 *      description="Market L5 Swagger OpenApi description",
 *     @OA\Contact(
 *         email="dima8045@ukr.net"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     )
 * @OA\Server(
 *     description="Market API local host",
 *     url="http://market.loc/api/v1"
 * )
 */

class Controller extends \App\Http\Controllers\Controller
{

}