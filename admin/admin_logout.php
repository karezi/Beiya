<?php
 require_once("admin_flib.php");
 session_start();
 
 //store admin_user to test if logged in 
 $old_admin=$_SESSION['admin_user'];

 unset($_SESSION['admin_user']);
 $result_destroy=session_destroy();

 show_site_header("Logging Out");
 
 if(!empty($old_admin))
 {
 	if($result_destroy)
 	{
 		echo "Logged out successfully!<br/>";
 	    show_url("admin_login.php","Login");
 	    show_url("../index.php","Index");
 	}
 	else {
 		echo "Could not log you out somehow!<br/>";
 	}
 }
 else{
 	echo "Not logged in, how is it loggically possible to logged out?<br/>"; 	
    show_url("admin_login.php","Login");
 	show_url("../index.php","Index");
 } 
 show_site_footer();
?>