<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->nullable()->comment('交易号');
            $table->string('card_no')->nullable()->comment('卡号');
            $table->string('accno')->nullable()->comment('账号');
            $table->integer('amount')->nullable()->comment('金额');
            $table->char('merchant_id', 30)->nullable()->comment('本系统商户号（存在且在收单关系中建立）');
            $table->string('terminal_id')->nullable()->comment('终端号');
            $table->string('rrn')->nullable()->comment('系统主机流水');
            $table->string('return_code')->nullable();
            $table->string('rcDetail')->nullable();
            $table->string('auth_no')->nullable()->comment('授权号');
            $table->string('txnDate')->nullable()->comment('交易日期');
            $table->string('txnTime')->nullable()->comment('交易时间');
            $table->string('settleDate')->cnullable()->omment('清算日期');
            $table->char('order_id', 40)->nullable()->comment('订单Id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_logs');
    }
}
