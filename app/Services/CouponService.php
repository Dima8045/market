<?php


namespace App\Services;

use App\Helpers\StrHelper;

/**
 * Class CouponService
 * @package App\Http\Services
 */
class CouponService
{
    /**
     * Prepare coupon data before saving
     *
     * @param array $data
     * @return array
     */
    public function prepareToStore(array $data)
    {
        $date = StrHelper::rebuildDateRangeFormat(['start_date' => $data['start_date'], 'end_date' => $data['end_date']]);
        if (!empty($data['active']))
            $data['active'] = true;

        return array_merge($data, $date);
    }
}
