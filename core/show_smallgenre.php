<?php
 require("../libs/Smarty.class.php");
 require("../main.php");
 require_once("../fclib/beiya_fclib.php");

 if(isset($_GET['sgenid']))
 {
  session_start();
  $sgenid=$_GET['sgenid'];
  $name=get_smallgenre_name($sgenid);
  
  $smarty->assign("smallgenre",$name);
  $smarty->assign("header","Let's see what ".$name." got:<br/>");
  $smarty->assign("footer","Copyright:Van Ryan && Karezi");
 
  $cate_array=get_categories($sgenid); //get an array of small genres
  $str_cates=getHtmlStr_categories($cate_array);  //turn these small genres [array] to a string with html tags


  $smarty->assign("show_smallgen",$str_cates);

  $smarty->display("show_smallgenre.html");
 }else{
 	echo "<div style=\"text-algin:center;text-shadow=0.7px,0.7px,0.7px;
 	font-size:35px;font-family:sans-serif;\">
 	Don't you wanna fool me!</div>";
 }
?>