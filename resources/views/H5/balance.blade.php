@extends('H5.layouts.base')

@section('content')

	<div class="msg">
		<div class="msg_title">订单信息</div>
		<div class="msg_list">
			<ul>
				<li>卡名称：易通卡</li>
				<li>卡号：{{ $card_no }}</li>
				<li>卡内余额：<i>{{ $amount }}元</i></li>
			</ul>
		</div>
		<div class="mask"></div>
	</div>

	<a href="javascript:void(0)" onclick="self.location=document.referrer;" class="submit">返 回</a>

@endsection