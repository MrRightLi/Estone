@extends('Admin.Base')

@section('title','| 商户添加-添加')

@section('stylesheets')
    <style type="text/css">
        .red_star {
            color: #f00;
        }
    </style>

@section('content')

    <div class="dux-tools">
        <div class="bread-head"> 商户详情
        </div>
        <br>
        <div class="tools-function clearfix">
            <div class="float-left">
                <a class="button button-small bg-main icon-list" href="">
                    <i class="iconfont">&#xe603;</i>商户详情</a>
            </div>
        </div>
    </div>

    @include('Admin.partials._message')

    <div class="admin-main">
        <form method="post" class="form-x dux-form form-auto" id="post_form"
              action="{{ url("admin/merchant/update/$merchant->id") }}">
            <div class="panel dux-box  active">
                <div class="panel-head">
                    <strong>商户详情</strong>
                </div>
                <div class="hidden">
                    <input type="hidden" id="merchant-id" value="{{ $merchant->id }}">
                    {{ csrf_field() }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="label">
                            <label>商户号</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="merchant_id" size="20" datatype="*1-10" value="{{ $merchant->merchant_id }}"/>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="red_star">*</span>必填项
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>终端号</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="terminal_id" size="20" datatype="*1-10" value="{{ $merchant->terminal_id }}"/>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="red_star">*</span>必填项
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>商户名称</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="merchant_name" size="20" datatype="*1-10" value="{{ $merchant->merchant_name }}"/>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="red_star">*</span>必填项
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>商户分组</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="merchant_group" value="{{ $merchant->merchant_group }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>开户行账号</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="open_account_no" value="{{ $merchant->open_account_no }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>账户名称</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="open_account_name" value="{{ $merchant->open_account_name }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>结算行</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="payoff_name" value="{{ $merchant->payoff_name }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>签约时间</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="sign_date" value="{{ $merchant->sign_date }}"/>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="red_star">*</span>必填项,例如:2010-10-10
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>到期时间</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="fire_date" value="{{ $merchant->fire_date }}"/>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="red_star">*</span>必填项,例如:2010-10-10
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>地区代码</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="zone_cide" value="{{ $merchant->zone_cide }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>商家状态</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="status" value="{{ $merchant->status }}"/>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="red_star">*</span>必填项,0 代表商户状态不可用,1 代表商户状态可用
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label>IP白名单</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="ip" size="20" datatype="*1-10" value="{{ $merchant->ip }}"/>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                    class="red_star">*</span>必填项
                        </div>
                    </div>

                    <div class="panel-foot">
                        <div class="form-button">
                            <div id="tips"></div>
                            <button class="button bg-main" id="button_submit" type="button">保存</button>
                            {{--<button class="button bg" type="reset">重置</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@section('scripts')
    <script type="text/javascript">
        $('#button_submit').click(function () {
            $("#post_form").submit();
        });
    </script>
@endsection