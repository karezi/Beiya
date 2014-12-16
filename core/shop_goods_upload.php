<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php");

 session_start();


 $goodUpload_form=get_upload_form();


 $smarty->assign("goodUploadform",$goodUpload_form);
 $smarty->assign("header",getHeader());
 $smarty->assign("footer",getFooter());
 $smarty->assign("navigation",getNavigation());
 $smarty->display("shop_goods_upload.html");
?>
