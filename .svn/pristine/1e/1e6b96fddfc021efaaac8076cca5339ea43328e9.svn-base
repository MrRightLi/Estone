<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BalanceController extends Controller {
	public function index(Request $request) {
		$input = $request -> all();

        $validator = Validator::make($input, [
            'card_no' => 'required|digits:19',
            'amount' => 'required|min:0'
        ]);

        if ($validator -> fails()) {
            return view('H5/errors/error') -> with('error_content', '入参有误');
        }

		$display_data = array(
			'card_no' => $input['card_no'],
			'amount' => sprintf('%.2f', $input['amount'] / 100),
		);

		return view('H5/balance' , $display_data);
	}
}
