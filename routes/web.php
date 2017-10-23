<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/** 测试路由 */
Route::get('YTTest/index', 'YTTestController@index');

Route::post('YTTest/transNotify', 'YTTestController@transNotify');
Route::get('YTTest/sendAsyncRequest', 'YTTestController@sendAsyncRequest');
Route::get('YTTest/GuzzleHttpClient', 'YTTestController@GuzzleHttpClient');

/** 后台路由 **/
// Authentication Routes
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/index/{route?}', 'Admin\YTAdminController@index')->name('admin_entrance'); // 后台入口界面;
Route::get('admin/headPage', 'Admin\YTAdminController@headPage');
Route::get('admin/merchant/list', 'Admin\YTMerchantController@index');
Route::get('admin/merchant/show/{id}', 'Admin\YTMerchantController@show')->name('merchant_detail');
Route::post('admin/merchant/update/{id}', 'Admin\YTMerchantController@update');
Route::get('admin/merchant/add', 'Admin\YTMerchantController@add');
Route::post('admin/merchant/store', 'Admin\YTMerchantController@store');

/** inner routes */
// 前端
Route::get('search', 'SearchController@index') -> name('search');    // 查询页面
Route::get('success/{trans_no}', 'SuccessController@index') -> name('success');    // 交易成功页面
Route::get('search/captcha/{tmp}', 'SearchController@captcha') -> name('getCaptcha');    // 验证码图片获取
Route::post('search/submit', 'SearchController@submit') -> name('searchSubmit');    // 查询提交
Route::post('index/submit', 'IndexController@submit') -> name('paySubmit');    // 交易提交
Route::post('balance/index', 'BalanceController@index') -> name('balance');    // 查询结果页面
Route::get('/', 'IndexController@indexDefault');    // 首页默认页面
Route::get('/{trans_no}', 'IndexController@index') -> name('indexGet');    // 首页有订单号默认页面
Route::get('balance/index', function(){
	return Redirect::to('search');
});    // 查询结果默认

// 后端
Route::post('YT/queryBalance', 'YTController@queryBalance'); // 余额查询
Route::post('YT/transationBuild', 'YTController@transationBuild'); // 生成交易记录
Route::post('YT/queryTransactionInfo', 'YTController@queryTransactionInfo'); // 交易信息查询
Route::post('YT/merchantPay', 'YTController@merchantPay'); // 在线交易
Route::post('transaction/refound', 'YTController@refound'); // 退款

/** outside routes */
Route::post('/', 'IndexController@entry');    // POST入口
