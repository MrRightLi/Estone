<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    const RETURN_CODE_SUCCESS = '00';
    /**
     * 交易日志创建
     */
    public function buildTransationLog($transaction_id, $card_num, $yt_pay_result) {
        \Log::info('buildTransationLog-Model-param', array('transaction_id' => $transaction_id));

        $pan = isset($yt_pay_result->pan) ? $yt_pay_result->pan : '';
        $accno = isset($yt_pay_result->accno) ? $yt_pay_result->accno : '';
        $amount = isset($yt_pay_result->trAmt) ? $yt_pay_result->trAmt : '';
        $merchant_id = isset($yt_pay_result->mid) ? $yt_pay_result->mid : '';
        $terminal_id = isset($yt_pay_result->tid) ? $yt_pay_result->tid : '';
        $rrn = isset($yt_pay_result->rrn) ? $yt_pay_result->rrn : '';
        $return_code = isset($yt_pay_result->rc) ? $yt_pay_result->rc : '';
        $rcDetail = isset($yt_pay_result->rcDetail) ? $yt_pay_result->rcDetail : '';
        $auth_no = isset($yt_pay_result->authNo) ? $yt_pay_result->authNo : '';
        $txnDate = isset($yt_pay_result->txnDate) ? $yt_pay_result->txnDate : '';
        $txnTime = isset($yt_pay_result->txnTime) ? $yt_pay_result->txnTime : '';
        $settleDate = isset($yt_pay_result->settleDate) ? $yt_pay_result->settleDate : '';
        $order_id = isset($yt_pay_result->voucher) ? $yt_pay_result->voucher : '';

        $param = array(
            'transaction_id' => $transaction_id,
            'card_num' => $card_num,
            'card_no' => $pan,
            'accno' => $accno,
            'amount' => $amount * 100,
            'merchant_id' => $merchant_id,
            'terminal_id' => $terminal_id,
            'rrn' => $rrn,
            'return_code' => $return_code,
            'rcDetail' => $rcDetail,
            'auth_no' => $auth_no,
            'txnDate' => $txnDate,
            'txnTime' => $txnTime,
            'settleDate' => $settleDate,
            'order_id' => $order_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $id = $this->insertGetId($param);

        if ($id) {
            return $id;
        } else {
            \Log::info('buildTransationLog-Model-result', array('buildTransationLog-Model-result' => '生成交易记录失败'));
        }
    }
}
