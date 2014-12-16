<?php
 require("../libs/Smarty.class.php");
 require("../main.php");
 require_once("../fclib/beiya_fclib.php");

 if(isset($_GET['bgenid']))
 {
  session_start();
  $bgenid=$_GET['bgenid'];
  $name=get_biggenre_name($bgenid);
  
  $smarty->assign("biggenre",$name);
  $smarty->assign("header","Let's see what ".$name." got:<br/>");
  $smarty->assign("footer","Copyright:Van Ryan && Karezi");
 
  $smallgens=get_smallgens($bgenid); //get an array of small genres
  $str_smallgens=getHtmlStr_smallgens($smallgens);  //turn these small genres [array] to a string with html tags


  $smarty->assign("show_smallgens",$str_smallgens);

  $smarty->display("show_biggenre.html");
 }else{
 	echo "<div style=\"text-algin:center;text-shadow=0.7px,0.7px,0.7px;
 	font-size:35px;font-family:sans-serif;\">
 	Don't you wanna fool me!</div>";
 }
?>