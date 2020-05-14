<?php

namespace App\Http\Controllers\Api\v1;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * @OA\Post(
     *     path="/coupons/get-by-code",
     *     operationId="Coupon By Code",
     *     tags={"CouponByCode"},
     *     summary="Get coupon by code",
     *     requestBody={"$ref": "#/components/requestBodies/CouponGetByCode"},
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *              @OA\JsonContent(
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          description="Coupon Id"
     *                      ),
     *                      @OA\Property(
     *                          property="code",
     *                          type="string",
     *                          description="Coupon code",
     *                      ),
     *                      @OA\Property(
     *                          property="start_date",
     *                          type="string",
     *                          description="Coupon start date"
     *                      ),
     *                      @OA\Property(
     *                          property="end_date",
     *                          type="string",
     *                          description="Coupon end date"
     *                      ),
     *                      @OA\Property(
     *                          property="type",
     *                          type="string",
     *                          description="Coupon discont type (fixed, persent)",
     *                          default="fixed"
     *                      ),
     *                      @OA\Property(
     *                          property="amount",
     *                          type="number",
     *                          description="Coupon discont mount",
     *                          default="0.00"
     *                      ),
     *                      @OA\Property(
     *                          property="active",
     *                          type="boolean",
     *                          description="Coupon activety",
     *                          default="1"
     *                      ),
     *                      @OA\Property(
     *                          property="is_used",
     *                          type="boolean",
     *                          description="Was coupon used or not",
     *                          default="0"
     *                      ),
     *                      @OA\Property(
     *                          property="created_at",
     *                          type="string",
     *                          description="Created at",
     *                      ),
     *                      @OA\Property(
     *                          property="updated_at",
     *                          type="sting",
     *                          description="Upated at",
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     */
    /**
     * Get coupon by code
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getByCode(Request $request)
    {
        $coupon = Coupon::whereCode($request->input('code'))->first();
        return response($coupon);
    }
}
