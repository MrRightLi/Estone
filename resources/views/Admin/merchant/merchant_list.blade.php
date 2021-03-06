@extends('Admin.Base')

@section('title','| 商户列表')

@section('content')
    <div class="dux-tools">
        <div class="bread-head">商户管理</div>
        <br>
        <div class="tools-function clearfix">
            <div class="float-left">
                <a class="button button-small bg-main icon-list" href="{{ url("admin/merchant/list") }}">
                    <i class="iconfont"></i>
                    商户列表
                </a>
                <a class="button button-small bg-main icon-list" href="{{ url("admin/merchant/add") }}">
                    <i class="iconfont"></i>
                    添加商户
                </a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="table" class="table table-hover ">
            <tbody>
            <tr>
                <th width="*">编号</th>
                <th width="*">商户名称</th>
                <th width="*">商户号</th>
                <th width="*">终端号</th>
                <th width="*">商户分组</th>
                <th width="*">开户行账号</th>
                <th width="*">开户名称</th>
                <th width="*">结算行</th>
                <th width="*">签约时间</th>
                <th width="*">到期时间</th>
                <th width="*">地区代码</th>
                <th width="*">商家状态</th>
                <th width="*">商户秘钥</th>
                <th width="*">IP白名单</th>
                <th width="*">操作</th>
            </tr>
            @foreach($merchants as $merchant)
                <tr>
                    <td style="text-align: center">{{ $merchant->id }}</td>
                    <td>
                        <a href="">{{ $merchant->merchant_name }}</a>
                    </td>
                    <td>{{ $merchant->merchant_id }}</td>
                    <td>{{ $merchant->terminal_id }}</td>
                    <td>{{ $merchant->merchant_group }}</td>
                    <td>{{ $merchant->open_account_no }}</td>
                    <td>{{ $merchant->open_account_name }}</td>
                    <td>{{ $merchant->payoff_name }}</td>
                    <td>{{ $merchant->sign_date }}</td>
                    <td>{{ $merchant->fire_date }}</td>
                    <td>{{ $merchant->zone_cide }}</td>
                    <td>{{ $merchant->status }}</td>
                    <td>{{ $merchant->security_key }}</td>
                    <td>{{ $merchant->ip }}</td>
                    <td>
                        <a class="button bg-blue button-small icon-pencil" href="{{ url("admin/merchant/show/$merchant->id") }}"> <i class="iconfont"></i>
                        </a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

    {{ $merchants->links() }}

@section('scripts')
    <script type="text/javascript">
        $(function () {
            console.log("欢迎来到商户管理后台");

        });
    </script>
@endsection