<?php

function upload_picture(){
	require_once("../fclib/beiya_fclib.php");

	if ((($_FILES["goodspic"]["type"] == "image/gif")
	|| ($_FILES["goodspic"]["type"] == "image/jpeg")
	|| ($_FILES["goodspic"]["type"] == "image/pjpeg"))
	&& ($_FILES["goodspic"]["size"] < 20000)){
	
		if ($_FILES["goodspic"]["error"] > 0){
			echo "Return Code: " . $_FILES["goodspic"]["error"] . "<br />";
		}
	    else{
			echo "Upload: " . $_FILES["goodspic"]["name"] . "<br />";
			echo "Type: " . $_FILES["goodspic"]["type"] . "<br />";
			echo "Size: " . ($_FILES["goodspic"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["goodspic"]["tmp_name"] . "<br />";
	
			if (file_exists("upload/" . $_FILES["goodspic"]["name"])){
				echo $_FILES["goodspic"]["name"] . "宸茬\xBB\x8F瀛\x98\xE5\x9C\xA8";
			}
			else{
				move_uploaded_file($_FILES["goodspic"]["tmp_name"],
				"upload/" . $_FILES["goodspic"]["name"]);
				echo "淇\x9D瀛\x98\xE5\x9Cㄤ\xBA\x86: " . "upload/" . $_FILES["goodspic"]["name"];
			}
		}
	}
	else{
		echo "\xE9\x9D\x9E娉\x95\xE6\x96\x87浠讹\xBC\x81";
	}
}

function create_commId($conn){
	$query = "select * from comminfo";
	$result = mysqli_query($conn, $query);
	return $result->num_rows + 10000;
}

function getPhotoId($conn){
	$query = "select * from comminfo";
	$result = mysqli_query($conn, $query);
	return $result->num_rows + 20000;
}

function insert_goodsinfo($comminfo){
	try{
		$conn = db_connect();
		$commId = create_commId($conn);
		if($comminfo['cateId'] != 0){
			$query = "insert into comminfo (commId, cateId, shopId, commDescription, commPhotoId, isbn, price) " . 
					 "values ('" . $commId . "', '" . $comminfo['cateId'] . 
					 "', '" . $comminfo['shopId'] . "', '" . $comminfo['commDescription'] . 
					 "', '" . getPhotoId($conn) . "', '0', '" . $comminfo['price'] . "')";
		}
		else{
			$query = "insert into comminfo (commId, cateId, shopId, commDescription, commPhotoId, isbn, price," . 
					 " commTitle, author, press) " . 
					 "values ('" . $commId . "', '" . $comminfo['cateId'] . 
					 "', '" . $comminfo['shopId'] . "', '" . $comminfo['commDescription'] . 
					 "', '" . getPhotoId($conn) . "', '1', '" . $comminfo['price'] . 
					 "', '" . $comminfo['commTitle'] . "', '" . $comminfo['author'] . 
					 "', '" . $comminfo['press'] . "')";
		}
		mysqli_query($conn, $query);
		mysqli_close($conn);
	} 
	catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}
?>