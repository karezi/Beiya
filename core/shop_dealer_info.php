<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的店铺信息</title>
</head>

<body>
<body>
<div id="header">页眉</div>
<div id="mainbody">
<?php
require("../fclib/dealer_func.php");
session_start();
if(isset($_SESSION['valid_user'])){
	echo "我的店铺信息：". get_info($_SESSION['valid_user'], 'userId') . "<br />";
}
?>
</div>
<div id="footer">页脚</div>
</body>
</body>
</html>