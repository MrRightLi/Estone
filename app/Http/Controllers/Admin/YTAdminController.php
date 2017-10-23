<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class YTAdminController extends Controller
{
    public function index($route = null)
    {
//        return view('admin.login');
        if (empty($route)) {
            $route = url('admin/merchant/list');
        } else {
            $route_str = str_replace('_','/',$route);
            $route = url($route_str);
        }
        return view('Admin.index')->with(['route' => $route]);
    }
}
