<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php");

 session_start();


$shopInfo_form="";
if(isset($_SESSION['valid_user'])){
	$row = get_shop_info($_SESSION['valid_user']);  
	$shopInfo_form=get_shopinfo_form($row);	// these functions r in shop_func.php
}
else{
	$shopInfo_form="<div>您还没有<a href=\"/core/usr_login.php\"><b>登录</b></a>或者<a href=\"/core/usr_register_new.php\"><b>注册哦</b></a></div>";
}

 $smarty->assign("shopInfoform",$shopInfo_form);
 $smarty->assign("header",getHeader());
 $smarty->assign("footer",getFooter());
 $smarty->assign("navigation",getNavigation());
 $smarty->display("shop_welcome.html");
?>
