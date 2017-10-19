<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YTAdminController extends Controller
{
	public function index()
	{
		// return view("Admin.index");
		return view("Admin.main");
	}
}
