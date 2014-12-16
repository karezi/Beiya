<?php
require_once("admin_flib.php");
 
 //as long as there is a session, this page gotta have this function
 session_start();
 //html
 show_site_header("Insert commodity"); //this function is in admin_flib.php
 if(isset($_SESSION['admin_user']))
 {
 	if(isset($_POST['cateId'])&&isset($_POST['shopId'])&&isset($_POST['commTitle'])&&isset($_POST['price']))
   {
 	$cateId=$_POST['cateId'];
 	$shopId=$_POST['shopId'];
 	$commTitle=$_POST['commTitle'];
 	$price=$_POST['price'];
    
    //process into the database
 	$conn=db_connect(); //this function is in admin_flib.php

    $query="insert into comminfo(`cateId`,`shopId`,`commTitle`,`price`)           
           values('".$cateId."','".$shopId."','".$commTitle."','".$price."')";  //insert with "`" or without it, not with "'"
 	$result=$conn->query($query);
 	if(!$result)
 	{
 		echo "Cannot insert this commodity into database!";
 	}
 	else{
 		echo "<p>Commodity <em>".
 		     stripslashes($commTitle)."</em> was added to the database.</p>"; 
 		show_url("insert_commodity_form.php","Continue inserting");
 	}
  }
  else{
  display_comminsert_form();
  }
 }
 else{ 
 	echo "<h2><i>Not authorized.</i></h2>";
 	show_url("admin_login.php","Administrators log in here");
 }
 show_site_footer();
?>