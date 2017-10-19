<?php

namespace App\Http\Controllers\Admin;

use App\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class YTMerchantController extends Controller
{
    protected $merchant;

    function __construct()
    {
        $this->merchant = new Merchant();
    }

    /**
     * 商户列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = $this->merchant->getMerchantList(20);

        return view("Admin.merchant.merchant_list")->withMerchants($merchants);
    }

    /**
     * 商户添加
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view("Admin.merchant.merchant_add");
    }

    /**
     * 商户详情
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchant_detail = $this->merchant->merchantDetail($id);

        return view('Admin.merchant.merchant_detail')->withMerchant($merchant_detail);
    }

    /**
     * 新建商户
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'merchant_id' => 'required|max:255',
            'terminal_id'  => 'required|max:255',
            'merchant_name'  => 'required|max:255',
            'merchant_group'  => 'max:255',
            'open_account_no'  => 'max:255',
            'open_account_name'  => 'max:255',
            'payoff_name'  => 'max:255',
            'zone_cide'  => 'max:255',
            'sign_date'  => 'required|date',
            'fire_date'  => 'required|date',
            'status'  => 'required|boolean',
            'ip'  => 'required|ipv4',
        ));

        // Save the data to the database
        $data = array(
            'merchant_id' => $request->input('merchant_id'),
            'terminal_id'  => $request->input('terminal_id'),
            'merchant_name'  => $request->input('merchant_name'),
            'merchant_group'  => $request->input('merchant_group'),
            'open_account_no'  => $request->input('open_account_no'),
            'open_account_name'  => $request->input('open_account_name'),
            'payoff_name'  => $request->input('payoff_name'),
            'sign_date'  => $request->input('sign_date'),
            'fire_date'  => $request->input('fire_date'),
            'zone_cide'  => $request->input('zone_cide'),
            'status'  => $request->input('status'),
            'ip'  => $request->input('ip'),
        );
        $result = $this->merchant->createMerchant($data);

        // set flash data with success message
        if ($result) {
            Session::flash('success', '新建商户成功');

            return redirect()->route('merchant_detail', $result);
        } else {
            Session::flash('error', '新建商户失败');
        }
    }

    /**
     * 更新商户信息
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'merchant_id' => 'required|max:255',
            'terminal_id'  => 'required|max:255',
            'merchant_name'  => 'required|max:255',
            'merchant_group'  => 'max:255',
            'open_account_no'  => 'max:255',
            'open_account_name'  => 'max:255',
            'sign_date'  => 'required|date',
            'fire_date'  => 'required|date',
            'payoff_name'  => 'max:255',
            'zone_cide'  => 'max:255',
            'status'  => 'required|boolean',
            'ip'  => 'required|ipv4',
        ));

        // Save the data to the database
        $data = array(
            'merchant_id' => $request->input('merchant_id'),
            'terminal_id'  => $request->input('terminal_id'),
            'merchant_name'  => $request->input('merchant_name'),
            'merchant_group'  => $request->input('merchant_group'),
            'open_account_no'  => $request->input('open_account_no'),
            'open_account_name'  => $request->input('open_account_name'),
            'payoff_name'  => $request->input('payoff_name'),
            'sign_date'  => $request->input('sign_date'),
            'fire_date'  => $request->input('fire_date'),
            'zone_cide'  => $request->input('zone_cide'),
            'status'  => $request->input('status'),
            'ip'  => $request->input('ip'),
        );

        $result = $this->merchant->updateMerchant($id, $data);

        // set flash data with success message
        if ($result) {
            Session::flash('success', '成功修改商户信息');
        } else {
            Session::flash('error', 'error');
        }

        // redirect with flash data to merchant show
        return redirect()->route('merchant_detail', $id);
    }
}
