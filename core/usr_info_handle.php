<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php");

session_start();

 $smarty->assign("header",getHeader());
 $smarty->assign("footer",getFooter());
 $smarty->assign("navigation",getNavigation());

 
 $smarty->display("usr_info_handle.html");
?>