<?php

// f1 we use this function to know if this commodity is a book
function check_if_book($commid){
  $conn=new_db_connect();
  $query="select isbn from comminfo where commId='".$commid."'";
  $result=$conn->query($query);
  $result=$result->fetch_assoc();
  $resutl=$result['isbn'];
  if($result!=0)
  {
    return 1;
  }else{
    return 0;
  }
}

// f2 we use this function to check the "like" number, 
//and return it as a number
//This function is DEPRECATED!


// f3 check and get the name of a commodity
//@@@@@@@@@@@@@@@@@  This function is DEPRECATED!


// f4 check and get the shopname by shopid
function check_shopname($shopid) 
{
	$conn=new_db_connect();
	$query="select shopName where `shopId`='".$shopid."'";
    $result=$conn->query($query);
	if(!$result)
	{
		return "Anonymous";
	}
	else {
		$shopname=$result->fetch_object()->shopName;
		return $shopname;
	}
}

// f5 check if the photo exists, if not, we use the default photo
function check_photo($photoid)  
{
	if($photoid)
	{
		return $photoid;
	}
	else{
		return "default0";
	}
}

// f6 check and return the customer's phone number,address,post code as an object
function check_receiptorInfo($username)
{
  $conn=new_db_connect();
  $query="select * from userInfo where userName='".$username."'";
  $result=$conn->query($query); 
  $result=$result->fetch_object();
  return $result;
}

// f7 check if the user is a dealer
function check_if_dealer($username){   
  $conn=new_db_connect();
  $query="select shopId from userInfo where userName='".$username."'";
  $result=$conn->query($query);
  if($result){  //this user owns a shop
    $conn->close();
   return true; 
  }else{ //not a shop owner
    $conn->close();
   return false;
  }
}

// f8 check the shopid of a commodity
function check_shopid_viaComm($commid){
  $conn=new_db_connect();
  $query="select shopId from comminfo where `commId`='".$commid."'";
  $result=$conn->query($query);
  if(!$result)
  {
    $result=$result->fetch_assoc();
    $result=$result['shopId'];
    return $result;
  }
  else return false;
}

// f9 check the shop info
function check_shop_info($shopid){
  $conn=new_db_connect();
  $query="select * from shopInfo where shopId='".$shopid."'";
  $result=$conn->query($query);
  if(!$result){
    return false;
  }
  else{
    $result=$result->fetch_object();
    return $result;
  }
}

// f10 check if the user already have one address (when we need to insert a new address)
function check_exist_address($username){
  $conn=new_db_connect();
  $query="select userAddr,userSecAddr from userinfo where userName='".$username."'";
  $result=$conn->query($query);
  $result=$result->fetch_assoc();
  if(@ $result['userAddr'] && !$result['userSecAddr']){
    return 'one';
  } else if (@ $result['userAddr'] && $result['userSecAddr']){
    return 'two';
  } else {
    return 'no';
  }

}

//f11 check the name of the user with his id
function check_user_name($uid){
  $conn=new_db_connect();
  $query="select userName from userinfo where userId='".$uid."'";
  $result=$conn->query($query);
  $result=$result->fetch_assoc();
  $result=$result['userName'];
  if($result)
    return true;
  else return false;
}

//f12 get the userid with his name
function check_userId($username){
  try{
    $conn = db_connect();
    $query = "select userId from userinfo where userName = '".$username."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    return $row['userId'];
    mysqli_close($conn);
  } catch(Exception $e){
        echo $e->getMessage();
        exit();
  }
}


//f13 check_passwd() in 'usr_info_hdl_re.php'
function check_passwd($username,$old_pass){
  $conn=new_db_connect();
  $query="select passWord from userinfo where userName='".$username."'";
  $result=$conn->query($query);
  $result=$result->fetch_assoc();
  if($old_pass==$result['passWord']){
    return true;
  } else {
    return false;
  }
}
//f14 validate_pass()
function validate_pass($pass){
  if(eregi('/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,16}$/', $pass)){
    return true;
  } 
    return false;
}

//f15 change_pass()
function change_pass($new_pass,$username){
  $conn=new_db_connect();
  $query="update userinfo set `passWord`='".$new_pass."' where userName='".$username."'";
  $result=$conn->query($query);
  if($result){
    return true;
  }
  return false;
}

//f16 checknchangePWs() in 'usr_info_hdl_re.php'
function checknchangePWs($old_pass,$new_pass,$new_pass2,$username){
  if(check_passwd($old_pass)){
    if($new_pass!=$new_pass2){
      if(validate_pass($new_pass)){
        if(change_pass($new_pass,$username)){
          return 'success';
        } else {
          return 'db_failure';
        }
      } else {
        return 'invalid';
      }
    } else{
      return 'dontmatch';
    }
  } else{
    return 'op_wr';
  }
}

?>