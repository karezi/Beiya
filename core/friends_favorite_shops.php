<?php

require_once("../fclib/beiya_fclib.php");
require("../main.php");
require("../fclib/fri_func.php");

 session_start();

 if(@ $_SESSION['valid_user']){

 	$fav_shops_list=get_fav_shops_list($_SESSION['valid_user']);  // a list of ids 
 	if ($fav_shops_list) {
 		$fav_shops_list=explode("#", $fav_shops_list);  // an array of ids
 		$feeds_list=get_fav_shops_feedsinfo($fav_shops_list);  // we'll get an array of associate array here
 		unset($fav_shops_list);
 		if(!$feeds_list){
 			$main_block="<div>The shops you fancy appear not active at all... Shade...</div>";
 		} else {
 			// need to make it more dazzling!!!
 			$main_block="<div class=\"feeds_block\">";

 			// get the html string done
 			// we may add some more features here (user's own page or communication)
 			foreach($feeds_list as $feedinfo){
 				$main_block=$main_block."<div class=\"feed\">
 							 <div class=\"feed_usr_img\"><a href=\"#\"><img src=\"/img/users/".$feedinfo['au_id'].".jpg\" /></a></div>
 							 <span class=\"feed_usr_name\"><a href=\"#\">".$feedinfo['au_name']."</a></span>
 							 <span class=\"feed_time\">".$feedinfo['timestamp']."</span>
 							 <span class=\"feed_content\">".$feedinfo['content']."</span>
 							</div>";
 			}

 			$main_block=$main_block."</div>"; 
 		}	

 	} else {
 		
 		$main_block="<div>Take a good look at shops! Here are our recommendations:</div>";
 	}

 } else{
 	// Not a valid user
 	$main_block="<div>
 	              Please sign in, dear friend.
 				 </div>";
 }

 $smarty->assign("head_content",getHead_content());
 $smarty->assign("header",getHeader());
 $smarty->assign("navigation",getNavigation());
 $smarty->assign("footer",getFooter());
 $smarty->assign("main_block",$main_block);
 
 $smarty->display("friends_favorite_shops.html");

?>