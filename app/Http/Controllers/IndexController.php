<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use Redirect;
use Log;

class IndexController extends Controller {
    public function indexDefault() {
        $device = $this -> judgeDevice();
        return view($device . '/errors/404');
    }

    /** 支付入口
     * @param Request $request
     */
    public function entry(Request $request) {
        $device = $this -> judgeDevice();
        $input = $request -> all();
        Log::info('trans entry input param#', $input);

        $validator = Validator::make($input, [
            'order_id' => 'required|digits:20',
            'amount' => 'required|min:0',
            'order_time' => 'required|date',
            'merchant_id' => 'required|digits:15',
            'terminal_id' => 'required|digits:8',
            'return_url' => 'required|active_url',
            'notify_url' => 'required|active_url',
            'device' => 'required',
            'sign' => 'required|max:32',
        ]);

        if ($validator -> fails()) {
            return view($device . '/errors/error') -> with('error_content', '入参有误');
        }

        $post_url = url('YT/transationBuild');
        $post_data = array(
            'order_id' => $input['order_id'],
            'amount' => $input['amount'],
            'order_time' => $input['order_time'],
            'merchant_id' => $input['merchant_id'],
            'terminal_id' => $input['terminal_id'],
            'return_url' => $input['return_url'],
            'notify_url' => $input['notify_url'],
            'device' => $input['device'],
            'sign' => $input['sign'],
            'ip' => $this->getIp()
        );

        Log::info('trans create output param#', $post_data);

        $client = new \GuzzleHttp\Client();
        $post_response = $client -> request('POST', $post_url, ['form_params' => $post_data]);
        $post_response = json_decode($post_response -> getBody(), TRUE);

        if ($post_response['status'] == 'fail') {
            if ($post_response['msg'] == '重复交易') {
                return view($device . '/repeat');
            } else {
                return view($device . '/errors/error') -> with('error_content', $post_response['msg']);
            }
        }

        Session::put($post_response['data']['transaction_no'], $input['sign']);

        return Redirect::route('indexGet', $post_response['data']['transaction_no']);
    }

    /** 支付页渲染
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

        Log::info('trans display output param#', $post_data);

        $client = new \GuzzleHttp\Client();
        $post_response = $client -> request('POST', $post_url, ['form_params' => $post_data]);
        $post_response = json_decode($post_response -> getBody(), TRUE);

        if ($post_response['status'] == 'fail') {
            return view($device . '/errors/error') -> with('error_content', $post_response['msg']);
        }

        $display_data = array(
            'order_id' => $post_response['data']['order_id'],
            'amount' => sprintf('%.2f', $post_response['data']['amount'] / 100),
            'order_time' => $post_response['data']['order_time'],
            'merchant_id' => $post_response['data']['merchant_id'],
            'merchant_name' => $post_response['data']['merchant_name'],
            'terminal_id' => $post_response['data']['terminal_id'],
            'transaction_no' => $trans_no
        );

        return view($device . '/index', $display_data);
    }

    /** 支付提交
     * @param Request $request
     */
	public function submit(Request $request) {
        $device = $this -> judgeDevice();

		$card_no = $request -> card_no;
		$password = $request -> password;
		$order_id = $request -> order_id;
        $merchant_id = $request -> merchant_id;
        $transaction_no = $request -> transaction_no;
        $ip = $this->getIp();
        $request = array(
            'transaction_no' => $transaction_no,
            'merchant_id' => $merchant_id,
            'order_id' => $order_id
        );

        $validator = Validator::make($request, [
            'transaction_no' => 'required|digits:20',
            'merchant_id' => 'required|digits:15',
            'order_id' => 'required|digits:20',
        ]);

        if ($validator -> fails()) {
            return view('errors/404') -> with('error_content', '入参有误');
        }

        $sign = md5($merchant_id . $order_id);

		$ajax_response = array();
        $post_url = url('YT/merchantPay');
        $post_data = array(
        	'transaction_no' => $transaction_no,
            'card_num' => $card_no,
        	'password' => $password,
        	'sign' => $sign,
            'ip' => $ip,
            'device' => $device,
        );

        Log::info('trans submit output param#', $post_data);

        $client = new \GuzzleHttp\Client();
        $post_response = $client -> request('POST', $post_url, ['form_params' => $post_data]);
        $post_response = json_decode($post_response -> getBody(), TRUE);

        $ajax_response['status'] = $post_response['status'];
        $ajax_response['msg'] = $post_response['msg'];

		return response() -> json($ajax_response);
	}
}