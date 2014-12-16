<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php");

 session_start();


 
 $logout_disp="";

 if(isset($_SESSION['valid_user'])){
 	//store valid_user to test if logged in 
  $old_user=$_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  $result_destroy=session_destroy();
  if(!empty($old_user))
  {   
 	if($result_destroy)
 	{   //if we can log him out 
        $logout_disp="登出成功<br/>
                      <div>
                        <ul>
                         <li><a href=\"/core/usr_login.php\">Log in</a></li>
                         <li><a href=\"/index.php\">Main Page</a></li>
                        </ul>
                      </div>";
 	}
 	else {
 		//if we cannot log him out due to unknown factors
 		$logout_disp="Could not log you out somehow!<br/>";
 	}
  }
 } else{  //Not logged in
 	$logout_disp="Not logged in, how is it loggically possible to logged out?<br/>
 	              <div>
                        <ul>
                         <li><a href=\"/core/usr_login.php\">Log in</a></li>
                         <li><a href=\"/index.php\">Main page</a></li>
                        </ul>
                      </div>";
 }

 $head_content=getHead_content();


 $smarty->assign("head_content",$head_content);
 $smarty->assign("header",getHeader());
 $smarty->assign("footer",getFooter());
 $smarty->assign("navigation",getNavigation());
 $smarty->assign("logout_disp",$logout_disp);
 
 $smarty->display("usr_logout.html");
?>