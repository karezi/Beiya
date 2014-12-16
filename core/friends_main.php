<?php
 require_once("../fclib/beiya_fclib.php");
 require("../main.php");
 require("../fclib/fri_func.php");

 session_start();

 if(@ $_SESSION['valid_user']){
 	// If there's a valid user signed in
 	$friends_list=get_friends_list($_SESSION['valid_user']);  // a list of ids
 	if ($friends_list) {
 		$friends_list=explode("#", $friends_list);
 		$feeds_list=get_friends_feedsinfo($friends_list);  // we'll get an array of associate array here
 		unset($friends_list);
 		if(!$feeds_list){
 			$main_block="<div>Oooops... Your friends appear not active at all... Such a shame...</div>";
 		} else {
 			// need to make it more dazzling!!!
 			$main_block="<div class=\"feeds_block\">";

 			// get the html string done
 			// we may add some more features here (user's own page or communication)
 			foreach($feeds_list as $feedinfo){
 				$main_block=$main_block."<div class=\"feed\">
 							 <div class=\"feed_usr_img\"><a href=\"#\"><img src=\"/img/users/".$feedinfo['userId'].".jpg\" /></a></div>
 							 <span class=\"feed_usr_name\"><a href=\"#\">".$feedinfo['userName']."</a></span>
 							 <span class=\"feed_time\">".$feedinfo['timestamp']."</span>
 							 <span class=\"feed_content\">".$feedinfo['content']."</span>
 							</div>";
 			}

 			$main_block=$main_block."</div>"; 
 		}	

 	} else {
 		// He's got no friend!
 		$main_block="<div>Make some friends! Here are our recommendations:</div>";
 	}
 } else{
 	// Not a valid user
 	$main_block="<div>
 	              Please sign in, dear friend.
 				 </div>";
 }


 
 $head_content=getHead_content();
 $header=getHeader();
 $footer=getFooter(); 

 $smarty->assign("head_content",$head_content);
 $smarty->assign("header",$header);
 $smarty->assign("navigation",getNavigation());
 $smarty->assign("footer",$footer);
 $smarty->assign("main_block",$main_block);
 
 $smarty->display("friends_main.html");
?>