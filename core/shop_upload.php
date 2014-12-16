<?php
 require_once("../fclib/beiya_fclib.php");
 session_start();
 if(isset($_SESSION['userId'])){
	$shopId = $_SESSION['shopId'];
	$userId = $_SESSION['userId'];
	$describe = $_POST['goods-describe'];
	$price = $_POST['goods-price'];
	$cateId = $_POST['cate'];
	if($cateId == 0){
		$commTitle = $_POST['commTitle'];
		$author = $_POST['author'];
		$press = $_POST['press'];
		$comminfo = array(
					"shopId" => $shopId,
					"cateId" => $cateId, 
					"userId" => $userId, 
					"commDescription" => $describe, 
					"price" => $price,
					"commTitle" => $commTitle,
					"author" => $author,
					"press" => $press
					);
	}
	else{
		$comminfo = array(
					"shopId" => $shopId,
					"cateId" => $cateId, 
					"userId" => $userId, 
					"commDescription" => $describe, 
					"price" => $price
					);
	}
//	upload_picture();
	insert_goodsinfo($comminfo);
	jump_with_alert("success!", "/core/shop_goods_upload.php");
 }
?>