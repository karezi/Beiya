<?php
 require_once("../fclib/beiya_fclib.php");
 
 session_start();
 if(isset($_SESSION['userId'])){
	$shopId = $_SESSION['shopId'];
	$shopName = $_POST['shopName'];
	$dealerPhoneNo = $_POST['dealerPhoneNo'];
	$dealerAddr = $_POST['dealerAddr'];
	$dealerEmail = $_POST['dealerEmail'];
	$shopDescription = $_POST['shop-describe'];
	$shopinfo = array(
				"shopName" => $shopName,
				"dealerPhoneNo" => $dealerPhoneNo, 
				"dealerAddr" => $dealerAddr, 
				"dealerEmail" => $dealerEmail, 
				"shopDescription" => $shopDescription
				);
//	upload_picture();
	insert_shopinfo($shopinfo, $shopId);
	jump_with_alert("success!", "/core/shop_welcome.php");
 }
?>