@extends('PC.layouts.base')

@section('content')

    <div class="m1200 mt_v">
        <div class="od">
            <h3>易通卡余额查询</h3>
            <div class="div_items">
                <label class="w100">卡名称：</label>
                <span class="cards_names">易通卡</span>
            </div>
            <div class="div_items">
                <label class="w100">输入卡号</label>
                <input type="text" name="cards_num" id="cards_num" autocomplete="off" class="cards_num w375" placeholder="请正确输入卡号" />
                <label class="error"></label>
            </div>
            <div class="div_items">
                <label class="w100">输入密码</label>
                <input type="password" name="cards_num" id="pay_password" autocomplete="off" class="pay_password w375" placeholder="请输入支付密码" />
                <label class="error"></label>
            </div>
            <div class="div_items">
                <label class="w100">验证码</label>
                <input type="text" name="captcha" id="x_codes" autocomplete="off" class="x_codes w169" placeholder="请输入右图中的验证码" />
                <a onclick="javascript:re_captcha();">
                    <img src="{{ route('getCaptcha', '1') }}" alt="验证码" title="刷新图片" width="90" height="34" id="c2c98f0de5a04167a9e427d883690ff6" border="0" style="margin-left: 20px; vertical-align:middle;">
                </a>
                <label class="error"></label>
            </div>
            {{ csrf_field() }}
        </div>
        <div class="align">
            <input class="submit_btns" onclick="submit_forms()" value="查询" />
        </div>
    </div>

    <script type="text/javascript">
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
            var flag = 0;

            var card_no = $.trim($('#cards_num').val());
            var password = $.trim($('#pay_password').val());
            var captcha = $.trim($('#x_codes').val());

            //定义错误信息
            var error_msg = {
                'card_no': '请输入易通卡卡号',
                'password': '请输入易通卡密码',
                'password_wrong': '密码错误',
                'captcha_input': '请输入验证码',
                'captcha_wrong': '验证码错误'
            };

            if (!card_no) {
                $('.error').eq(0).html(error_msg.card_no).css({ 'color': '#ff0000', 'marginLeft': '8px' }).show();
                flag = 1;
                re_captcha();
                $('#x_codes').val('');
            } else {
                $('.error').eq(0).hide();
            };

            if (!password) {
                $('.error').eq(1).html(error_msg.password).css({ 'color': '#ff0000', 'marginLeft': '8px' }).show();
                flag = 1;
                re_captcha();
                $('#x_codes').val('');
            } else {
                $('.error').eq(1).hide();
            };

            if (!captcha) {
                $('.error').eq(2).html(error_msg.captcha_input).css({ 'color': '#ff0000', 'marginLeft': '8px' }).show();
                flag = 1;
                re_captcha();
                $('#x_codes').val('');
            } else {
                $('.error').eq(2).hide();
            };

            if (flag == 1) {
                return false;
            } else {
                var data = {
                    'card_no': card_no,
                    'password': password,
                    'captcha': captcha,
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
                            swal({
                                title: '您当前卡内余额为' + amountFormat($response['data']['balAmt'], 1) + '元',
                                confirmButtonText: '确定'
                            });
                        } else if (status == 'fail') {
                            if ($response['msg'] == '验证码错误') {
                                $('.error').eq(2).html(error_msg.captcha_wrong).css({ 'color': '#ff0000', 'marginLeft': '8px' }).show();
                            } else {
                                swal({
                                    title: $response['msg'],
                                    type: "error",
                                    confirmButtonText: '确定'
                                });
                            }
                        }
                        re_captcha();
                        $('#x_codes').val('');
                    }
                });
            }
        }
    </script>

@endsection