<?php
require_once("../fclib/beiya_fclib.php");
require_once("../fclib/shop_func.php"); 
session_start();
if(isset($_SESSION['userId'])){
	$userId = $_SESSION['userId'];
	$_SESSION['shopId'] = init_shop($userId);
	set_isDealer($userId);
	$_SESSION['drop'] = 0;
	jump_with_alert("welcome!", "shop_fill_info.php");
}
?>