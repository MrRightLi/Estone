<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->nullable()->comment('交易号');
            $table->tinyInteger('notify_status')->default(0)->comment('交易状态;0为普通状态,1:通知失败,2:通知成功');
            $table->tinyInteger('msg')->nullable()->comment('通知回执消息');
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
        Schema::dropIfExists('notifies');
    }
}
