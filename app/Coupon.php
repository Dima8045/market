<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\RequestBody(
 *     request="CouponGetByCode",
 *     description="Riddle object that needs to be updated",
 *     required=true,
 *     @OA\MediaType(
 *          mediaType="application/x-www-form-urlencoded",
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="code",
 *                  type="string",
 *              ),
 *          )
 *     )
 * )
 */

class Coupon extends Model
{
    const COUPON_TYPE = ['percent', 'fixed'];

    protected $guarded = [];
}
