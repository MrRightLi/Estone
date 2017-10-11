<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refounds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_no')->nullable()->comment('卡号');
            $table->integer('amount')->nullable()->comment('退款金额');
            $table->string('merchant_id')->nullable()->comment('本系统商户号（存在且在收单关系中建立）');
            $table->string('terminal_id')->nullable()->comment('终端号');
            $table->string('rrn')->nullable()->comment('系统主机流水(原交易参考号)');
            $table->string('txnDate')->nullable()->comment('交易日期');
            $table->string('txnTime')->comment('交易时间');
            $table->string('return_code')->nullable();
            $table->string('rcDetail')->nullable();
            $table->longText('return_message')->nullable()->comment('易通退款返回消息');
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('refounds');
    }
}
