<?php
	function get_friends_list($username){
		$conn=new_db_connect();
		$query="select userBudId from userInfo where userName='".$username."'";
		$result=$conn->query($query);
		if($result){
			$result=$result->fetch_assoc();
			$conn->close();
			return $result['userBudId'];
		} else {
			$conn->close();
			return false;
		}
	}

	function get_friends_feedsinfo($friends_list){
		$conn=new_db_connect();
		$query="select * from feeds where idtype='f' && au_id in(";
		$len=count($friends_list);
		$i=0; #counter
		foreach($friends_list as $bud_id){
			if($i==$len-1){
				$query=$query.$bud_id.") ORDER BY id DESC LIMIT 20";
			} else {
				$query=$query.$bud_id.","; $i++;
			}		
		}  // end of "foreach"
		$result=$conn->query($query);
		if(!$result){
			return false;
		} else {
			return db_result_to_array($result);
		}

	}

	function get_fav_shops_list($username){
		$conn=new_db_connect();
		$query="select favshopsid from userInfo where userName='".$username."'";
		$result=$conn->query($query);
		if($result){
			$result=$result->fetch_assoc();
			$conn->close();
			return $result['favshopsid'];
		} else {
			$conn->close();
			return false;
		}
	}
	
	function get_fav_shops_feedsinfo($fav_shops_list){
		$conn=new_db_connect();
		$query="select * from feeds where idtype='s' && au_id in(";
		$len=count($fav_shops_list);
		$i=0; #counter
		foreach($fav_shops_list as $shop_id){
			if($i==$len-1){
				$query=$query.$shop_id.") ORDER BY id DESC LIMIT 20";
			} else {
				$query=$query.$shop_id.","; $i++;
			}		
		}  // end of "foreach"
		$result=$conn->query($query);
		if(!$result){
			return false;
		} else {
			return db_result_to_array($result);
		}

	}

	
	function get_notifs_feedsinfo($username){
		$conn=new_db_connect();
		$query="select au_name,timestamp,content,nread from feeds where idtype='n' && nuname='".$username."'";
		$result=$conn->query($query);
		if(!$result){
			return false;
		} else {
			return db_result_to_array($result);
		}

	}

	
?>