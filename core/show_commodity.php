<?php
 require("../libs/Smarty.class.php");
 require("../main.php");
 require_once("../fclib/beiya_fclib.php");

 if(isset($_GET['commid']))
 {
  session_start();
  $commid=$_GET['commid'];
  $name=get_comm_name($commid);
  
  $bk_flag=check_if_book($commid); //we are now checking if it's a book
  $details=get_comm_details($commid,$bk_flag); //get an array of commodity details
  
  $str_details=getHtmlStr_comm_details($details,$bk_flag);  //turn these details [array] to a string with html tags
  
  //now we deal with comments
   $comment="<hr/><div class=\"comment_block\">"; 
  //here is the part we get the comments
  $conn=new_db_connect();
  $query="select userName,commentText from commentinfo where idType=\"commodity\" and itemId=\"".$commid."\"";
  $result=$conn->query($query);
  if($result!=''){
    $result=db_result_to_array($result);
    if(is_array($result)){
       foreach($result as $row)
       {
        $comment=$comment."<div class=\"single_comment\">
                           <div class=\"comment_user\">".$row['userName']."</div>
                           <div class=\"comment_text\">".$row['commentText']."</div>  
                         </div>";
       }
    $comment=$comment."</div><br/>";
    }
  } else{
    $comment="<hr/>No comments now";
  }
 //finished dealing with comments
  $smarty->assign("title",$name);
  $smarty->assign("header",getHeader());

  $smarty->assign("show_comm_block1",$str_details);
  $smarty->assign("show_comm_block2",$comment);
  $smarty->assign("navigation",getNavigation());
  $smarty->assign("footer",getFooter());
  $smarty->display("show_comm.html");
 }else{
 	echo "<div style=\"text-algin:center;text-shadow=0.7px,0.7px,0.7px;
 	font-size:35px;font-family:sans-serif;\">
 	Don't you wanna fool me!</div>";
 }

?>