<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refound extends Model
{
    /** 生成退款日志
     * @param $param
     */
    public function createRefound($param) {
        \Log::info('createRefound--Model', ['param' => $param]);
        $data = array(
            'transaction_no' => isset($param['transaction_no']) ? trim($param['transaction_no']) : '',
            'card_no' => isset($param['card_no']) ? trim($param['card_no']) : '',
            'amount' => isset($param['amount']) ? $param['amount'] * 100 : '',
            'merchant_id' => isset($param['merchant_id']) ? trim($param['merchant_id']) : '',
            'terminal_id' => isset($param['terminal_id']) ? trim($param['terminal_id']) : '',
            'rrn' => isset($param['rrn']) ? trim($param['rrn']) : '',
            'txnDate' => isset($param['txnDate']) ? trim($param['txnDate']) : '',
            'txnTime' => isset($param['txnTime']) ? trim($param['txnTime']) : '',
            'return_code' => isset($param['return_code']) ? trim($param['return_code']) : '',
            'rcDetail' => isset($param['rcDetail']) ? trim($param['rcDetail']) : '',
            'remark' => isset($param['remark']) ? trim($param['remark']) : '',
            'return_message' => isset($param['return_message']) ? trim($param['return_message']) : '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $result = $this->insert($data);
        \Log::info('createRefound--result', ['result' => $result]);
    }
}
