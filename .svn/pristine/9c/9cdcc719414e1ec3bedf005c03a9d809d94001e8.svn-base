<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    const NOTIFY_STATUS_COMMON = 0;
    const NOTIFY_STATUS_ERROR = 1;
    const NOTIFY_STATUS_SUCCESS = 2;

    /** 创建订单完成回执
     * @param array $param
     * @return int
     */
    public function createNotify(array $param = [])
    {
        if (empty($param))
            return false;
        $data = array(
            'transaction_id' => isset($param['transaction_id']) ? intval($param['transaction_id']) : '',
            'notify_status' => Notify::NOTIFY_STATUS_COMMON,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $id = $this->insertGetId($data);

        return $id;
    }

    public function updateNotify(array $param = [])
    {
        \Log::info('updateNotify-Model', ['param' => $param]);
        if (empty($param))
            return false;
        $notify_id = isset($param['notify_id']) ? intval($param['notify_id']) : '';
        $data = array(
            'notify_status' => isset($param['notify_status']) ? intval($param['notify_status']) : Notify::NOTIFY_STATUS_ERROR,
            'updated_at' => date('Y-m-d H:i:s'),
            'msg' => isset($param['msg']) ? $param['msg'] : ''
        );

        if ($notify_id)
            $this->where('id', $notify_id)->update($data);
    }

    public function exceptiveOrderInfo() {
        $exceptive_order_list = $this->where('notify_status', Notify::NOTIFY_STATUS_ERROR)->select('id','transaction_id','notify_status')->get();

        return $exceptive_order_list->toArray();
    }
}
