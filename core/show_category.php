<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php");
 

 if(isset($_GET['cateid']))
 {
    session_start();
    $cateid=$_GET['cateid'];
    $name=get_category_name($cateid);
    


  
  //the default pagesize is 10
    $pagesize=10;
  
    $maxPageNum=count_maxPageNum($cateid,$pagesize);  //Maybe needs honing to accelerate this process

    if(isset($_GET['page'])){
     $page=$_GET['page'];
    if($page==0)
    {
      $page=1;
    }
    if($page>$maxPageNum)
      {
        $page=$maxPageNum;
      }
  }
  else{
    $page=1;
  } 

  $comms=get_comms($cateid,$page,$pagesize); //get an array of commodities  /this function is in comm_disp_fclib.php
  $str_comms=getHtmlStr_comms($comms,$page,$maxPageNum);  //turn these commodities [array] to a string wit html tags  &&  also with the administration of page number

  $smarty->assign("name",$name);
  $smarty->assign("header",getHeader());
  $smarty->assign("navigation",getNavigation());
  $smarty->assign("footer",getFooter());
  $smarty->assign("show_cate",$str_comms);
  $smarty->display("show_cate.html");
 }else{
 	echo "<script type=\"text/javascript\">
           window.location.href=\"../index.php\";
        </script>";
 }
?>