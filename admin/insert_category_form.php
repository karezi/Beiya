<?php
 require_once("admin_flib.php");
 
 //as long as there is a session, this page gotta have this function
 session_start();
 //html
 show_site_header("Insert category"); //this function is in admin_flib.php
 
 //check if it's an administrator
 if(isset($_SESSION['admin_user']))
 {
  if(isset($_POST['cateId'])&&isset($_POST['cateName']))
  {
 	$cateId=$_POST['cateId'];
 	$cateName=$_POST['cateName'];
    
    //process into the database
 	$conn=db_connect(); //this function is in admin_flib.php

    $query="insert into categories(cateId,cateName) values('".$cateId."','".$cateName."')";
 	$result=$conn->query($query);
 	if(!$result)
 	{
 		echo "Cannot insert this category into database!";
 	}
 	else{
 		echo "<p>Category <em>".
 		     stripslashes($cateName)."</em> was added to the database.</p>"; 
 		show_url("insert_category_form.php","Continue inserting");
 	}
  }
  else{
  display_cateinsert_form();
  }
  
}
 else{
 	echo "<h2><i>Not authorized.</i></h2>";
 }
 show_site_footer();
?>