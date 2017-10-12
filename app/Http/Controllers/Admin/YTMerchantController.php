<?php

namespace App\Http\Controllers\Admin;

use App\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $merchants = $this->merchant->getMerchantList(1);

        return view("admin.merchant.merchant_list")->withMerchants($merchants);
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

        return view('admin.merchant.merchant_add')->withMerchantDetail($merchant_detail);
    }

    /**
     * 新建商户
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save a new category and then redirect back to index
        $this->validate($request, array(
            'name' => 'required|max:255'
        ));

        $category = new Category();

        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'New Category has been created');

        return redirect()->route('categories.index');
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
        //
    }

    /**
     * 删除商户
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
