<?php
 require("../main.php");
 require_once("../fclib/beiya_fclib.php");
 require_once("../fclib/cart_func.php");
 
 function get_fresh_orderId(){
 	// get a new orderId
 	$conn=new_db_connect();
 	$query="select top 1 orderId from orderinfo ORDER BY orderId DESC";
 	$result=$conn->query($query);
 	if($result){
 		$result=$result->fetch_assoc();
 		$conn->close();
 		return $result['orderId'];
 	} else{
 		$conn->close();
 		return 0;
 	}
 }

 function get_some_comminfo($commid){
 	$conn=new_db_connect();
 	$query="select shopId,price,commTitle,shopName from comminfo where commId=$commid";
 	$result=$conn->query($query);
 	$result=$result->fetch_assoc();
 	return $result;

 }

 session_start();

 // displaying the page
 $main_block="<br/><div><a href=\"/index.php\"> Go to Main Page </a>&nbsp;&nbsp;&nbsp;
          </div>";
 $head_content=getHead_content();
 $header=getHeader();
 $footer=getFooter();

 if(@ $_POST['confirm1']=="kiddingL7"){
 	
 	$conn=new_db_connect();

 	$num=get_fresh_orderId();
 	$num=intval($num);
 	if($num){
 		$frest_oid=$num+1;
 	} else{
 		$frest_oid=1;
 	}
 	unset($num);

 	$userId=check_userId($_SESSION['valid_user']);

 	$main_block="<div class=\"thks\">
 	               Success! Thank you for your orders!
 	             </div>";

 	foreach($_SESSION['cart'] as $commid=>$qty){
 		$comminfo=get_some_comminfo($commid);

 		$salesquery="update shopinfo set sales=sales+1 where shopId=".$comminfo['shopId'];
 		$result1=$conn->query($salesquery);
 		
 		$query="insert into orderinfo (orderId,commId,commTitle,userId,userName,receiptor,shopId,shopName,address,phoneNo,postCode,orderDate,amount,payment) 
 			values($frest_oid,$commid,'".$comminfo['commTitle']."',$userId,'".$_SESSION['valid_user']."','".$_SESSION['receiptorInfo']['receiptorname']."',".$comminfo['shopId'].",
 				'".$comminfo['shopName']."','".$_SESSION['receiptorInfo']['address']."',".$_SESSION['receiptorInfo']['phoneno'].",".$_SESSION['receiptorInfo']['postcode'].",
 				CURRENT_TIMESTAMP,$qty,".$comminfo['price']*$qty."
 				)";
		
	 	$result=$conn->query($query);
	 	if(!$result){
	 		$main_block="<div>There is something wrong. Please place your order again.</div>";
	 		break;
	 	}
	 }

 }else{
 	$main_block="<div class=\"nothing\">
 	               Go get some awesome stuff on BeiYa!
 	             </div>";
 }

 unset($_SESSION['receiptorInfo']['receiptorname'],$_SESSION['receiptorInfo']['address'],
 	$_SESSION['receiptorInfo']['userPhoneNo'],$_SESSION['receiptorInfo']['postCode'],
 	$_SESSION['cart']);

 $smarty->assign("header",$header);
 $smarty->assign("footer",$footer);
 $smarty->assign("main_block",$main_block);

 $smarty->display("cart_finish.html");
?>