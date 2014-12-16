<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php");

 session_start();


 //check if logged in
 
 if(isset($_POST['username']) && isset($_POST['password'])){
 	//if someone has just tried to log in
 	$username=$_POST['username'];
 	$encrypted_password=sha1($_POST['password']);

 	@ $db_conn=new mysqli('localhost','freenik','haxerocks','beiya');

 	if(mysqli_connect_errno())
 	{
 		echo 'Connection to database failed:'.mysqli_connect_error();
        exit();
 	}
 	$query="select * from userinfo where userName='".$username."' and passWord='".$encrypted_password."'";

 	$result=$db_conn->query($query);
 	if($result->num_rows>0)
 	{
 		//if in the database, we log him on
 		$row=mysqli_fetch_array($result);
 		$_SESSION['valid_user']=$username;
 		$_SESSION['shopId']=$row['shopId'];
 	}
 	$db_conn->close();
}

$login_disp="";

 if(isset($_SESSION['valid_user']))
 {
 	$login_disp=$login_disp."<div>You are logged in as: ".$_SESSION['valid_user']."</div><br/>";
 	$login_disp=$login_disp."<div>
 	                          <ul>
 	                           <li><a href=\"/core/usr_logout.php\">Log out</a></li>
 	                           <li><a href=\"/core/usr_change_password.php\">Change your password</a></li>
 	                           <li><a href=\"/core/usr_info_handle.php\">Handle your own info</a></li>
 	                          </ul>
 	                         </div>";
 } 
 else{

 	$login_disp=get_Html_loginForm();
	$login_disp=$login_disp."<br/><a href=\"/core/usr_register_new.php\">Register here!</a>
                          <br/><a href=\"/index.php\">Main Page</a>";
 }
 
 
 $head_content=getHead_content();
 $header=getHeader();
 $footer=getFooter(); 

 $smarty->assign("head_content",$head_content);
 $smarty->assign("header",$header);
  $smarty->assign("navigation",getNavigation());
 $smarty->assign("footer",$footer);
 $smarty->assign("login_disp",$login_disp);
 
 $smarty->display("usr_login.html");
?>