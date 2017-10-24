<div class="dux-head clearfix">
	<div class="dux-logo" style="line-height: 40px; font-size: 18px; color: #fff">
        陕西易通商户管理后台
	</div>
	<div class="dux-nav">
		<ul class="nav nav-navicon nav-inline admin-nav" id="nav">
			<li class="active"><a href="javascript:;" data="260" url="" class=""> 起始页</a></li>
		</ul>
		<ul class="nav nav-navicon nav-menu nav-inline admin-nav nav-tool">
			<li>
				<a class="dux-logout bg-red icon-power-off" href="{{ route('logout') }}"
				   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
					<i class="iconfont"></i>
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</li>
		</ul>
	</div>
</div>