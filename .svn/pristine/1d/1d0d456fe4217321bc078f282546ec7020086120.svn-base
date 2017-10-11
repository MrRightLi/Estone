<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('merchant_id')->nullable()->comment('商户号');
            $table->string('terminal_id')->nullable()->comment('终端号');
            $table->string('merchant_name')->nullable()->comment('商户名称');
            $table->string('merchant_group')->nullable()->comment('商户分组');
            $table->string('open_account_no')->nullable()->comment('开户行账号');
            $table->string('open_account_name')->nullable()->comment('账户名称');
            $table->string('payoff_name')->nullable()->comment('结算行');
            $table->date('sign_date')->nullable()->comment('签约时间');
            $table->date('fire_date')->nullable()->comment('到期时间');
            $table->date('zone_cide')->nullable()->comment('地区代码');
            $table->string('status')->nullable()->default(1)->comment('商家状态');
            $table->string('security_key')->nullable()->comment('商家密钥');
            $table->timestamps();
            // merchant_id,terminal_id,merchant_name,merchant_group,open_account_no.open_account_name,payoff_name,sign_date,fire_date,zone_cide
            // 商户号,终端号,商户名称,商户分组,开户行账号,账户名称,结算行,签约时间,到期时间,地区代码
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
