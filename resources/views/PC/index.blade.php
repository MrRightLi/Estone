@extends('PC.layouts.base')

@section('content')

    <div class="panel_table m1200">
        <div class="th">
            <i></i> 订单编号：{{ $order_id }}
        </div>
        <ul class="ul_item">
            <li class="list">
                商户名称：{{ $merchant_name }}
            </li>
            <li class="list">
                下单时间：{{ $order_time }}
            </li>
            <li class="list">
                订单金额： <strong class="money">{{ $amount }}元</strong>
            </li>
        </ul>
    </div>

    <div class="box_bg">
        <div class="m1200">
            <div class="od">
                <h3>支付信息</h3>
                <div class="div_items">
                    <label class="w100">卡名称：</label>
                    <span class="cards_names">易通卡</span>
                    <a href="{{ route('search') }}" target="_blank" class="search_results">查询余额</a>
                </div>
                <div class="div_items">
                    <label class="w100">输入卡号</label>
                    <input type="text" name="cards_num" id="cards_num" autocomplete="off" class="cards_num w375" placeholder="请正确输入卡号" />
                    <label class="error"></label>
                </div>
                <div class="div_items">
                    <label class="w100">输入密码</label>
                    <input type="text" name="cards_num" id="pay_password" autocomplete="off" class="pay_password w375" placeholder="请输入支付密码" />
                    <label class="error"></label>
                </div>
                {{ csrf_field() }}
            </div>
            <div class="align">
                <input class="submit_btns" id="submit_forms" value="确认支付" />
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $('#submit_forms').click(function() {
                var click_flag = 0;

                if (click_flag == 0) {
                    click_flag = 1;
                    var flag = 0;

                    var card_no = $.trim($('#cards_num').val());
                    var password = $.trim($('#pay_password').val());

                    // 定义错误信息
                    var error_msg = {
                        'card_no': '请输入易通卡卡号',
                        'password': '请输入易通卡密码',
                        'password_wrong': '密码错误'
                    };

                    if (!card_no) {
                        $('.error').eq(0).html(error_msg.card_no).css({ 'color': '#ff0000', 'marginLeft': '8px' }).show();
                        flag = 1;
                    } else {
                        $('.error').eq(0).hide();
                    };

                    if (!password) {
                        $('.error').eq(1).html(error_msg.password).css({ 'color': '#ff0000', 'marginLeft': '8px' }).show();
                        flag = 1;
                    } else {
                        $('.error').eq(1).hide();
                    };

                    if (flag == 1) {
                        return false;
                    } else {
                        var data = {
                            'card_no': card_no,
                            'password': password,
                            'order_id': "{{ $order_id }}",
                            'merchant_id': "{{ $merchant_id }}",
                            'transaction_no': "{{ $transaction_no }}",
                            '_token': $("[name='_token']").val()
                        };

                        $.ajax({
                            url: "{{ route('paySubmit') }}",
                            type: 'POST',
                            dataType: 'json',
                            data: data,
                            success: function($response) {
                                var status = $response['status'];
                                if (status == 'success') {
                                    var transaction_no = "{{ $transaction_no }}";
                                    var url = "{{ route('success', 'transaction_no_replace') }}"
                                    url = url.replace('transaction_no_replace', transaction_no);
                                    location.assign(url);
                                } else if (status == 'fail') {
                                    if ($response['msg'] == '密码错误') {
                                        $('.error').eq(1).html(error_msg.password_wrong).css({ 'color': '#ff0000', 'marginLeft': '8px' }).show();
                                    } else {
                                        swal({
                                            title: $response['msg'],
                                            type: "error",
                                            confirmButtonText: '确定'
                                        });
                                    }
                                }

                                setTimeout(function(){click_flag = 0;}, 2000);
                            }
                        });
                    }
                }
            })
        })
    </script>

@endsection