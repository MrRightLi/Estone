<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>404页面</title>
		<style type="text/css">
			body{margin:0;padding:0;}	
			.img_error{text-align: center; margin-top: 200px;}
			.error_text{color: #499cde; font-size: 20px; margin-top: 80px; font-family: '微软雅黑'}
		</style>
	</head>
	<body>
		<div class="img_error">
			<img src="/image/PC/error.png" />
			<div class="error_text">{{ $error_content }}</div>
		</div>
	</body>
</html>