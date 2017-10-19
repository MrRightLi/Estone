<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('Admin.partials._headerbase')
</head>

<body>

@yield('content')
@include('Admin.partials._footerbase')

@include('Admin.partials._javacript')
@yield('scripts')

</body>

</html>