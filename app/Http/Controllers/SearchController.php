<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gregwar\Captcha\CaptchaBuilder;
use GuzzleHttp\Client;
use Session;
use Log;

class SearchController extends Controller {
    /** 支付页渲染
     */
	public function index() {
		$device = $this -> judgeDevice();
		return view($device . '/search');
    }

    /** 验证码生成
     * @param string $tmp
     */
    public function captcha($tmp) {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;

        //可以设置图片宽高及字体
        $builder -> build($width = 80, $height = 27, $font = null);

        //获取验证码的内容
        $phrase = $builder -> getPhrase();

        //把内容存入session
        Session::flash('milkcaptcha', $phrase);

        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder -> output();
    }

    /** 搜索提交
     * @param Request $request
     */
	public function submit(Request $request) {
		$card_no = $request -> card_no;
		$password = $request -> password;

		//读取验证码
		$captcha = Session::get('milkcaptcha');

		$ajax_response = array();
		if ($request -> captcha == $captcha) {

	        $post_url = url('YT/queryBalance');
	        $post_data = array(
	        	'card_num' => $card_no,
	        	'password' => $password,
	        );

	        Log::info('trans search submit output param#', $post_data);

	        $client = new \GuzzleHttp\Client();
	        $post_response = $client -> request('POST', $post_url, ['form_params' => $post_data]);

	        $post_response = json_decode($post_response -> getBody(), TRUE);
	        $ajax_response['status'] = $post_response['status'];
	        $ajax_response['msg'] = $post_response['msg'];
	        $ajax_response['data'] = $post_response['data'];
		} else {
			$ajax_response['status'] = 'fail';
			$ajax_response['msg'] = '验证码错误';
		}

		return response() -> json($ajax_response);
	}
}