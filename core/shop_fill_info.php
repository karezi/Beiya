<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php");

 session_start();


 $fillshopinfo_form="";
	if(isset($_SESSION['userId'])){
		$fillshopinfo_form=get_fillshopinfo_form();
	}

 $smarty->assign("head_content",getHead_content());
 $smarty->assign("fillShopInfo",$fillshopinfo_form);
 $smarty->assign("header",getHeader());
 $smarty->assign("footer",getFooter());
 $smarty->assign("navigation",getNavigation());
 $smarty->display("shop_fill_info.html");
?>