<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Log;

class SuccessController extends Controller {
    /** 支付成功页渲染
     * @param string $trans_no
     */
	public function index($trans_no) {
        $device = $this -> judgeDevice();

        $request = array(
            'trans_no' => $trans_no
        );

        $validator = Validator::make($request, [
            'trans_no' => 'required|digits:20',
        ]);

        if ($validator -> fails() || empty(Session::get($trans_no))) {
            return view($device . '/errors/error') -> with('error_content', '交易号有误');
        }

        $post_url = url('YT/queryTransactionInfo');
        $post_data = array(
            'transaction_no' => $trans_no,
        );

        Log::info('trans success output param#', $post_data);

        $client = new \GuzzleHttp\Client();
        $post_response = $client -> request('POST', $post_url, ['form_params' => $post_data]);
        $post_response = json_decode($post_response -> getBody(), TRUE);

        if ($post_response['status'] == 'fail') {
            return view($device . '/errors/error') -> with('error_content', $post_response['msg']);
        } else if (empty($post_response['data']['return_url'])) {
            return view($device . '/errors/error') -> with('error_content', '原商户地址不存在');
        }

		return view($device . '/success') -> with('return_url', $post_response['data']['return_url']);
    }
}