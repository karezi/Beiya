<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>删除商品</title>
</head>
<body>
<?php
	require_once("/fclib/beiya_fclib.php");
	$commId = $_GET['commId'];
	drop_goods($commId);
	show_url("/core/shop_goods_show.php", "success!,return");
?>
</body>
</html>