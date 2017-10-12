@extends('Admin.Base')

@section('title','| 商户添加-添加')

@section('stylesheets')
<style type="text/css">
    .red_star{
        color:#f00;
    }
</style>

@section('content')
<div class="dux-tools">
    <div class="bread-head"> 商户添加-添加
    </div>
    <br>
    <div class="tools-function clearfix">
        <div class="float-left">
            <a class="button button-small bg-main icon-list" href="{:U('Coupon/singleCouponList')}">
                <i class="iconfont">&#xe603;</i>商户添加添加</a>
        </div>
    </div>
</div>

<div class="admin-main">
    <form method="post" class="form-x dux-form form-auto" id="create_form" action="{:U('Coupon/singleCouponCreate')}">
        <div class="panel dux-box  active">
            <div class="panel-head">
                <strong>单品优惠券添加</strong>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="label">
                        <label>单品优惠券名称</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input single_name"  name="single_name" size="20"  datatype="*1-10" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;<span class="red_star">*</span>必填项
                    </div>
                </div>

                <div class="panel-foot">
                    <div class="form-button">
                        <div id="tips"></div>
                        <button class="button bg-main" id="button_submit" type="button">保存</button>
                        <button class="button bg" type="reset">重置</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@section('scripts')
<script type="text/javascript">
    $('#button_submit').click(function(){
        var str='优惠券名称：'+$('.single_name').val()+
            '<br/>领取方式：'+$('.send_type').filter(':checked').attr('show') +
            '<br/>关联商品ID：'+$('.good_id').val() +
            '<br/>券立减金额：' +$('.amount').val()+'元'+
            '<br/>发放时间：'+$('.send_start_date').val() +'~'+$('.send_end_date').val()+
            '<br/>使用时间：'+$('.use_start_date').val() +'~'+$('.use_end_date').val()+
            '<br/>平台限制：' +$('.platform').filter(':checked').attr('show')+
            '<br/>最多发放：' +$('.max_quantity').val()+'张';
    });
</script>
@endsection