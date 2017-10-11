@extends('H5.layouts.base')

@section('content')

	<div class="success_img">
		<p>支付成功</p>
		<img src="/image/H5/success.png" >
	</div>
	<a href="{{ $return_url }}" class="submit">返回商户</a>

@endsection