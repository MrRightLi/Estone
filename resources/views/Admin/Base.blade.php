<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('Admin.partials._headerbase')
    @yield('stylesheets')
</head>

<body>

@include('Admin.partials._message')
@yield('content')
@include('Admin.partials._footerbase')

@include('Admin.partials._javacript')
@yield('scripts')

</body>

</html>