<?php
require_once("../fclib/beiya_fclib.php");

session_start();
if(isset($_SESSION['valid_user'])){
	$userId = $_SESSION['userId'];
	drop_shop($userId);
	show_url("/core/usr_info_handle.php", "删除成功点，此处返回！");
	$_SESSION['drop']=1;
}
?>