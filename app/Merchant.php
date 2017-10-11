<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    const MERCHANT_STATUS_DISABLE = -1;
    const MERCHANT_STATUS_ENABLE = 1;

    /** 查询商户信息
     * @param $merchant_id
     * @return array
     */
    public function queryMerchantInfo($merchant_id)
    {
        \DB::enableQueryLog();
        $merchant_info = $this->where([
            ['merchant_id', '=', $merchant_id],
            ['status', '=', Merchant::MERCHANT_STATUS_ENABLE],
            ['fire_date', '>', date('Y-m-d')]
        ])->select('id', 'merchant_id', 'terminal_id', 'merchant_name', 'fire_date', 'security_key', 'status', 'ip')->get();
        $log = \DB::getQueryLog();
        \Log::info('queryMerchantInfo-sqllog', ['sqllog' => $log]);
        return $merchant_info->toArray();
    }

    /**
     * 获取商户列表
     *
     * @param $page_size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getMerchantList($page_size)
    {
        return $this->paginate($page_size);
    }

    /**
     * 商户详情
     *
     * @param $id
     * @return bool|Model|null|static
     */
    public function merchantDetail($id)
    {
        $id = isset($id) ? intval($id) : '';
        if ($id) {
            return $this->where('id', $id)->first();
        } else {
            return false;
        }
    }
}
