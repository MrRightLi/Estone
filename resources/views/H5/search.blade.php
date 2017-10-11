@extends('H5.layouts.base')

@section('content')

    <div class="msg_pay">
        <div class="pay_title">支付信息</div>
        <div class="pay_ipt">
            <ul>
                <li>
                    <span>卡名称：易通卡</span>
                </li>
                <li>
                    <span>卡号</span>
                    <input type="tel" placeholder="请正确输入卡号" id="car">
                </li>
                <li>
                    <span>密码</span>
                    <input type="password" placeholder="请输入支付密码" id="psd">
                </li>
                <li>
                    <span>验证</span>
                    <input type="text" placeholder="图中的验证码" id="auth_code">
                    <i class="change">换一张？</i>
                    <a href="javascript:;" class="auth_img" onclick="javascript:re_captcha();">
                        <img alt="验证码" title="刷新图片" width="80" height="20" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
                    </a>
                </li>
                {{ csrf_field() }}
            </ul>
        </div>
    </div>

    <a href="javascript:;" onclick="submit_forms()" class="submit">查 询</a>

    <script>
        $(function() {
            re_captcha();
            $('#auth_code').val('');
        }) 

        function re_captcha() {
            var url = "{{ route('getCaptcha', 'rand_num_replace') }}"
            url = url.replace('rand_num_replace', Math.random());
            document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src = url;
        }

        function amountFormat(amount_val, calculate_type) {
            if (calculate_type) {
                amount_val = amount_val / 100;
            }
            return amount_val.toFixed(2);
        }

        function submit_forms() {
            var reg_car = /^\d+$/;
            var val_car = $.trim($('#car').val());
            var val_psd = $.trim($('#psd').val());
            var val_auth_code = $.trim($('#auth_code').val());

            if (val_car == '') {
                layer.msg('请输入预付卡卡号');
                re_captcha();
                $('#auth_code').val('');
                return false;
            }

            if (!reg_car.test(val_car)) {
                layer.msg('卡号不正确，请重新输入');
                re_captcha();
                $('#auth_code').val('');
                return false;
            }

            if (val_psd == '') {
                layer.msg('请输入预付卡密码');
                re_captcha();
                $('#auth_code').val('');
                return false;
            }

            if (val_auth_code == '') {
                layer.msg('请输入验证码');
                re_captcha();
                $('#auth_code').val('');
                return false;
            }

            var data = {
                'card_no': val_car,
                'password': val_psd,
                'captcha': val_auth_code,
                '_token': $("[name='_token']").val()
            };

            $.ajax({
                url: "{{ route('searchSubmit') }}",
                type: 'post',
                dataType: 'json',
                data: data,
                success: function($response) {
                    var status = $response['status'];
                    if (status == 'success') {
                        form = $("<form method='post' action='{{ route('balance') }}'></form>");
                        input = $("<input type='hidden'>").val(val_car).attr('name', 'card_no');
                        form.append(input);
                        input = $("<input type='hidden'>").val($response['data']['balAmt']).attr('name', 'amount');
                        form.append(input);
                        input = $("<input type='hidden'>").val($("[name='_token']").val()).attr('name', '_token');
                        form.append(input);
                        $(document.body).append(form);
                        form.submit();
                    } else if (status == 'fail') {
                        if ($response['msg'] == '验证码错误') {
                            layer.msg('验证码错误', {icon: 2});
                        } else {
                            layer.msg($response['msg'], {icon: 2});
                        }
                        re_captcha();
                        $('#auth_code').val('');
                    }
                }
            });
        }
    </script>

@endsection