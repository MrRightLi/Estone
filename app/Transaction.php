<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const STATUS_COMMON = 0; // 交易初始状态
    const STATUS_FAIL = 1; // 交易失败
    const STATUS_SUCCESS = 2; // 交易成功

    public $timestamps = true;

    public function transationBuild($param)
    {
        \Log::info('transationBuild-param', $param);

        $transaction_no = date('YmdHis').str_pad(mt_rand(1, 99999), 6, '0', STR_PAD_LEFT) ;
        $param['transaction_no'] = $transaction_no;
        $param['transaction_status'] = 0;
        $param['created_at'] = date('Y-m-d H:i:s');
        $param['updated_at'] = date('Y-m-d H:i:s');

        $id = $this->insertGetId($param);
        $result = $this->where('id', $id)->first();

        \Log::info('transationBuild-Model--result', ['transationBuild-result' => $result->toArray()]);

        return $result->toArray();
    }

    /** 交易状态更新
     * @param $transation_id 交易id
     * @param $status 交易状态
     */
    public function updateTransactionStatus($transation_id, $status)
    {
        \Log::info('updateTransactionStatus-Model--param', ['transation_id' => $transation_id, 'status' => $status]);

        \DB::enableQueryLog();
        $this->where('id', $transation_id)->update(['transaction_status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
        $log = \DB::getQueryLog();
        \Log::info('updateTransactionStatus-sqllog', ['sqllog' => $log]);
    }

    /** 交易状态查询
     * @param $transation_id 交易id
     * @return array
     */
    public function transactionStatusQuery($transation_id)
    {
        $status = $this->where('id', $transation_id)->select('id', 'transaction_no', 'order_id', 'transaction_status', 'return_url', 'notify_url', 'amount','updated_at', 'order_time')->first();

        return $status->toArray();
    }

    /** 根据订单号查询交易
     * @param $order_id
     * @return Model|null|static
     */
    public function transactionByOrderId($order_id)
    {
        $transaction = $this->where('order_id', $order_id)->first();
        return $transaction;
    }

    /**
     * @param $transaction_id
     * @return Model|null|static
     */
    public function transactionBytransactionId($transaction_id)
    {
        $transaction = $this->where('id', $transaction_id)->first();
        return $transaction;
    }

    /** 根据订单号查询交易
     * @param $transaction_no
     * @return Model|null|static
     */
    public function transactionByTransactionNO($transaction_no)
    {
        $transaction = $this->where('transaction_no', $transaction_no)->first();
        return $transaction;
    }

    public function queryTransactionPayInfo($transaction_no) {
        // \DB::enableQueryLog();
        $pay_info = \DB::table('transactions')
                        ->leftJoin('transaction_logs', 'transactions.id', '=', 'transaction_logs.transaction_id')
                        ->where([
                            ['transactions.transaction_no', '=',$transaction_no],
                            ['transaction_logs.return_code','=',TransactionLog::RETURN_CODE_SUCCESS],
                        ])
                        ->select('transactions.merchant_id','transactions.terminal_id','transaction_logs.amount','transaction_logs.return_code','transaction_logs.rrn','transaction_logs.card_num')
                        ->first();

         \Log::info('pay_info', ['pay_info' => $pay_info]);

        // $sql_log = \DB::getQueryLog();
        // \Log::info('sql_log', $sql_log);

        return $pay_info;
    }
}
