<html>
<head>
	<meta name="viewport" content="initial-scale=1, user-scalable=0, minimal-ui">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>页面转跳</title>
	<style type="text/css">
		.sm{
			background-color: #F5F5F5;font-family: Courier New;font-size: 12px;border: 1px solid #CCCCCC;padding: 5px;overflow: auto;margin: 5px 0px;margin-top: 60px;margin-left: 60px;margin-right: 60px;
		}
		a:link,a:visited{
			text-decoration:none;  /*超链接无下划线*/
			color:#000000;
		}
		a:hover{
			text-decoration:none;  /*鼠标放上去有下划线*/
			color:#000000;
		}
	</style>
</head>
<body>
	<div class="sm">
		<center>
			<h1><?php echo $message;?></h1>
			<a id="href" href="<?php echo U($jumpUrl);?>">立即转跳</a>&nbsp;&nbsp;等待时间： <b style='color:#000000;' id="wait"><?php echo $waitSecond;?></b>
		</center>
		<center>Sm php framework</center>
		<div></div>
	</div>
</body>
</html>

<script type="text/javascript">
	(function(){
	var wait = document.getElementById("wait"),href = document.getElementById("href").href;
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
	})();
</script>