<?php
 require("admin_flib.php");
 session_start(); 
 if(!isset($_SESSION['admin_user'])){
 if(($_POST['adminname'])&&($_POST['password']))
 {
 	//someone just tried logging in

 	$adminname=$_POST['adminname'];
 	$password=$_POST['password'];

 	try{
 	if(login($adminname,$password))
 	{
 		//if we have this administrator
 		$_SESSION['admin_user']=$adminname;
 	}
    }
 	
 		//log in unsuccessfully
 		catch(Exception $e){
 		show_site_header("Problem!");
 		echo "<p>".$e->getMessage()."<br/>
 		     You must be logged in to view this page.</p>";
 		show_url("admin_login.php",'Admin Login');
 		show_site_footer();
 		exit();
 	    }
 	
 }
}
if(isset($_SESSION['admin_user']))
{
 show_site_header("Administration");
 display_admin_menu();
 show_url("admin_logout.php","logout");
 show_site_footer();
}
else {
	show_site_header("Wrong Gateway");
    echo "Not authorized.";
    show_site_footer();
}
?>