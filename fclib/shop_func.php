<?php
function create_dealerId(){
	try{
		$conn = db_connect();
		$query = "select * from userinfo where shopId>0";
		$result = mysqli_query($conn, $query);
		return $result->num_rows + 1000;
		mysqli_close($conn);
	} 
	catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}

function insert_dealerId($userId, $dealerId){
	try{
		$conn = db_connect();
		$query = "update userinfo set dealerId = '" . $dealerId . "' where userId = '".$userId."'";
		mysqli_query($conn, $query);
		mysqli_close($conn);
	} catch(Exception $e){
        echo $e->getMessage();
        exit();
	}
}

function init_shop($userId){
	try{
		$dealerId = create_dealerId();
		$conn = db_connect();
		$query = "insert into shopinfo (userId, shopId) values ('" . $userId . "', '" . $dealerId . "')";
		mysqli_query($conn, $query);
		mysqli_close($conn);
		insert_dealerId($userId, $dealerId);
		return $dealerId;
	} catch(Exception $e){
        echo $e->getMessage();
        exit();
	}
}

function set_isDealer($userId){
	try{
		$conn = db_connect();
		$query = "update userinfo set isDealer = 1 where userId = '".$userId."'";
		mysqli_query($conn, $query);
        mysqli_close($conn);
	} catch(Exception $e){
        echo $e->getMessage();
        exit();
	}
}

function drop_shop($userId){
	try{
		$conn = db_connect();
		$query = "update userinfo set isDealer = 0 where userId = '".$userId."'";
		mysqli_query($conn, $query);
		$query = "delete from shopinfo where userId = '" . $userId . "'";
		mysqli_query($conn, $query);
        mysqli_close($conn);
	} catch(Exception $e){
        echo $e->getMessage();
        exit();
	}
}

function get_goods($shopId){
	try{
		$conn = db_connect();
		$query = "select * from comminfo where shopId = '" . $shopId . "'";
		$result = mysqli_query($conn, $query);
		$i = 0;
		$rows = null;
		while($row = mysqli_fetch_array($result)){
			$rows[$i++] = $row;
		}
        mysqli_close($conn);
	} catch(Exception $e){
        echo $e->getMessage();
        exit();
	}
	return $rows;
}

function drop_goods($commId){
	try{
		$conn = db_connect();
		$query = "delete from comminfo where commId = '" . $commId . "'";
		mysqli_query($conn, $query);
        mysqli_close($conn);
	} catch(Exception $e){
        echo $e->getMessage();
        exit();
	}
}

function getShopPhotoId($conn){
	$query = "select * from shopinfo";
	$result = mysqli_query($conn, $query);
	return $result->num_rows + 30000;
}

function insert_shopinfo($shopinfo, $shopId){
	try{
		$conn = db_connect();
		$shopPhotoId = getShopPhotoId($conn);
		$query = "update shopinfo set shopName = '" . $shopinfo['shopName'] . 
				 "', shopPhotoId = '" . getShopPhotoId($conn) . 
				 "', dealerPhoneNo = '" . $shopinfo['dealerPhoneNo'] . 
				 "', dealerAddr = '" . $shopinfo['dealerAddr'] . 
				 "', dealerEmail = '" . $shopinfo['dealerEmail'] . 
				 "', shopDescription = '" . $shopinfo['shopDescription'] . 
				 "' where shopId = '" . $shopId . "'";
		echo $query;
		mysqli_query($conn, $query);
		mysqli_close($conn);
	} 
	catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}

function get_shop_info($username){
	try{
		$conn=new_db_connect();
		$userId=check_userId($username);
		$query = "select * from shopinfo where userId='".$userId."'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		mysqli_close($conn);
		return $row;
	} 
	catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}
?>