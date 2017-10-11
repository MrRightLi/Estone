@extends('H5.layouts.base')

@section('content')

    <div class="msg">
        <div class="msg_title">订单信息</div>
        <div class="msg_list">
            <ul>
                <li>订单号：{{ $order_id }}</li>
                <li>商户名称：{{ $merchant_name }}</li>
                <li>下单时间：{{ $order_time }}</li>
                <li>订单金额：<i>{{ $amount }}元</i></li>
            </ul>
        </div>
        <div class="mask"></div>
    </div>

    <div class="msg_pay">
        <div class="pay_title">支付信息</div>
        <div class="pay_ipt">
            <ul>
                <li>
                    <span>卡名称：易通卡</span>
                    <input onclick="location.href='{{ route('search') }}'" type="button" value="查询余额" id="see_about">
                </li>
                <li>
                    <span>卡号</span>
                    <input type="tel" placeholder="请正确输入卡号" id="car">
                </li>
                <li>
                    <span>密码</span>
                    <input type="password" placeholder="请输入支付密码" id="psd">
                </li>
                {{ csrf_field() }}
            </ul>
        </div>
    </div>

    <a class="submit" id="submit_forms">立即支付</a>

    <script type="text/javascript">
        $(function() {
            var click_flag = 0;

            $('#submit_forms').click(function() {
                if (click_flag == 0) {
                    click_flag = 1;

                    var reg_car = /^\d+$/;

                    var card_no = $.trim($('#car').val());
                    var password = $.trim($('#psd').val());
                    if (card_no == '') {
                        layer.msg('请输入预付卡卡号', {icon: 2});
                        return false;
                    } 
                    if (!reg_car.test(card_no)) {
                        layer.msg('卡号不正确，请重新输入', {icon: 2});
                        return false;
                    }
                    if (password == '') {
                        layer.msg('请输入预付卡密码', {icon: 2});
                        return false;
                    }

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
                                layer.msg($response['msg'], {icon: 2});
                            }

                            setTimeout(function(){click_flag = 0;}, 2000);
                        }
                    });
                }
            });
        })
    </script>

@endsection