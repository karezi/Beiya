<?php
 require_once("../fclib/beiya_fclib.php");
 require("../main.php");
 require("../fclib/fri_func.php");

 session_start();

 if(@ $_SESSION['valid_user']){
 	if(isset($_POST['auName'])&&isset($_POST['timestamp'])&&isset($_POST['content'])){
 		// if msgs via POST method are received
 		$main_block="<div class=\"msg_det\">
 						<div>".$_POST['auName']."</div>
 						<div>".$_POST['timestamp']."</div>
 						<div>".$_POST['content']."</div>
 					</div>";
 	}

 } else {
 	$main_block="<div><a href=\"/core/usr_login.php\"><b>Sign in</b></a> or 
 				<a href=\"/core/usr_register_new.php\"><b>join us</a></a> in Loogo!</div>";
 }

 $smarty->assign("head_content",getHead_content());
 $smarty->assign("header",getHeader());
 $smarty->assign("navigation",getNavigation());
 $smarty->assign("footer",getFooter());
 $smarty->assign("main_block",$main_block);
 
 $smarty->display("friends_msg_details.html");

?>