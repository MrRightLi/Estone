<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepeatController extends Controller {
	public function index() {
		$device = $this -> judgeDevice();
		return view($device . '/repeat');
    }
}