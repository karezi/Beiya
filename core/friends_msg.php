<?php
 require_once("../fclib/beiya_fclib.php");
 require("../main.php");
 require("../fclib/fri_func.php");

 session_start();

 if(@ $_SESSION['valid_user']){
 	
 		$feeds_list=get_notifs_feedsinfo($notifs_list);  // we'll get an array of associate array here

 		if(!$feeds_list){
 			$main_block="<div>您没有收到任何新的消息</div>";
 		} else {
 			// need to make it more dazzling!!!
 			$main_block="<div class=\"feeds_block\">";

 			// get the html string done
 			// we may add some more features here (user's own page or communication)
 			foreach($feeds_list as $feedinfo){
 				$feed_content=explode("#vn^si#", $feedinfo['content'],2);
 				$main_block=$main_block."<div class=\"feed\">
 							 <span class=\"feed_read_notif\">".$feedinfo['nread']."</span>
 							 <span class=\"feed_usr_name\"><a href=\"#\">".$feedinfo['au_name']."</a></span>
 							 <span class=\"feed_time\">".$feedinfo['timestamp']."</span>
 							 <span class=\"feed_content\"><a href=\"#\">".$feed_content[0]."</span>
 							</div><script type=\"text/javascript\">
 										$('div.feed span.feed_usr_name').click(function(){
 											var requestData={auName:\"".$feedinfo['au_name']."\",
 												timestamp:\"".$feedinfo['timestamp']."\",
 												content:\"".$feedinfo['content']."\" 
 												};
 											$.post('friends_msg_details.php',requestData);
 										});
 										
 									</script>";
 			}

 			$main_block=$main_block."</div>"; 
 		}	

 } else {
 	$main_block="<div><a href=\"/core/usr_login.php\"><b>Sign in</b></a> or 
 				<a href=\"/core/usr_register_new.php\"><b>join</a></a> in Loogo!</div>";
 }
 
 $smarty->assign("head_content",getHead_content());
 $smarty->assign("header",getHeader());
 $smarty->assign("navigation",getNavigation());
 $smarty->assign("footer",getFooter());
 $smarty->assign("main_block",$main_block);
 
 $smarty->display("friends_msg.html");
?>