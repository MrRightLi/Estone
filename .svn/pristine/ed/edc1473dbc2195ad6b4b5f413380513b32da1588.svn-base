<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->char('transaction_no', 40)->nullable()->comment('交易号');
            $table->char('order_id', 40)->nullable()->comment('订单号');
            $table->char('merchant_id', 30)->nullable()->comment('商户号');
            $table->string('terminal_id')->nullable()->comment('终端号');
            $table->integer('amount')->default(0)->comment('交易金额(分)');
            $table->tinyInteger('transaction_status')->default(0)->comment('交易状态');
            $table->string('ip')->nullable()->comment('ip地址');
            $table->string('remark')->nullable()->comment('备注');

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
        Schema::dropIfExists('transactions');
    }
}
