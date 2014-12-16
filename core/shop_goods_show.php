<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php");

 session_start();


 $goodsInfo_form="";
	if(isset($_SESSION['valid_user'])){
		$goodsInfo_form=get_goods_form($_SESSION['shopId']);
	}

 $smarty->assign("goodsInfoform",$goodsInfo_form);
 $smarty->assign("header",getHeader());
 $smarty->assign("footer",getFooter());
 $smarty->assign("navigation",getNavigation());
 $smarty->display("shop_goods_show.html");
?>
