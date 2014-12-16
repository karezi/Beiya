<?php
function register($username,$email,$password){
	//we are here to register this new user after checking his input data
	try{
		$conn=db_connect();

		$encrypted_password=sha1($password);
   
		$query="insert into userInfo(userName,passWord,userEmail) values('".$username."','".$encrypted_password."','".$email."')";
		$result=$conn->query($query);
		if (!$result)
        { 
           throw new Exception('Could not register you in database. Please try again later.');
        }
 
        return true;
        
	} catch(Exception $e)
	{
        echo $e->getMessage();
        exit();
	}

}

function get_fri_ids($uname){
  $conn=new_db_connect();
  $query="select userBudId from userinfo where userName=".$uname;
  $result=$conn->query($query);
  if(empty($result)){
  	$conn->close();
  	return false;
  }
  $frId_arr=explode("&",$result->fetch_array());

  $conn->close();
  return  $frId_arr;
}

function get_fri_names($uname){
  $frId_arr=get_fri_ids($uname);
  $frName_arr=array();
  foreach ($frId_arr as $id) {
     array_push($frName_arr,check_user_name($id)); //this function is from data_check.php 
  }
  return $frName_arr;
}

function rand_fri_recom(array $fri_arr,$count){  //we use this function to provide enough friend-recomed items
  /*
    parameter $count is the number of recoms we've got for now
    parameter $fri_arr is an array of names of friends
  */

  /*
    I don't wanna write this function for now!!!
    If you wanna go for it, I'm gonna stand up and give it up for ya!
    Yo!
  
  if($count>=5){
    */
    return false;
    /*  I just leave this line for this function to function! (Good one, right?)
  }
  $conn=new_db_connect();

  $conn->close();
  return $rand_fri_recom; 
  */
}

# for usr_info_hdl_re.php

// I'll change this into a form??
function get_own_info_hdl($username){
  $conn=new_db_connect();
  $query="select * from userinfo where userName='".$username."'";
  $result=$conn->query($query);
  $result=$result->fetch_assoc();

  $query="select shopName from shopInfo where shopId='".$result['shopId']."'";
  $result2=$conn->query($query);
  $result2=$result2->fetch_assoc();
  $conn->close();

  $html_result="<div class=\"usrId\">您的ID：".$result['userId']."</div>
          <div class=\"usrName\">您的用户名：".$result['userName']."</div>";
  if($result['userPhotoId']==0){
       $html_result=$html_result."<div class=\"usrPic\">
                                    <img src=\"/img/usrs/default0.jpg\">
                                    <span>上传自己的头像</span>
                                  </div>";
    } else {
      $html_result=$html_result."<div class=\"usrPic\">
                                    <img src=\"/img/usrs/".$result['userPhotoId'].".jpg\">
                                  </div>";
    }
  $html_result=$html_result."<div class=\"gender\">性别:".$result['gender']."</div> 
          <div class=\"usrEmail\">Email:".$result['userEmail']."</div>
          <div class=\"usrShop\"><div>商店：</div>";
  if($result2){
    // the user owns a shop
    $html_result=$html_result."<img src=\"/img/shops/thumb_".$result['shopId'].".png\" />
            <span>".$result['shopName']."</span>
          </div>";
  } else {
    $html_result=$html_result."<span>您还没有自己的商店呢</span>
                <span><a href=\"/core/shop_create.php\">创建一个吧！</a></span>
                </div>";
  }
          
    $html_result=$html_result."<div class=\"usrReceiveData\">您的收货信息：
                  <div class=\"receiDataTable\">
                  收货人姓名：".$result['receiptor']."<br/>
                  联系电话  ：".$result['userPhoneNo']."<br/>
                  收货人地址：".$result['userAddr']."<br/>
                  邮政编码  ：".$result['postCode']."<br/>
                  </div>
                  </div>";
  if(@ $result['receiptorSec']&&$result['userSecAddr']&&$result['userSecPhoneNo']&&$result['postcodeSec']){
    $html_result=$html_result."<div class=\"usrReceiveData2\">您的收货信息：
                  <div class=\"receiDataTable\">
                  收货人姓名：".$result['receiptorSec']."<br/>
                  联系电话  ：".$result['userSecPhoneNo']."<br/>
                  收货人地址：".$result['userSecAddr']."<br/>
                  邮政编码  ：".$result['postcodeSec']."<br/>
                  </div>
                  </div>";
  }
  $html_result=$html_result."<div class=\"usrDescrip\">您的个人简介:
                <div class=\"desc_context\">".$result['userDescription']."</div>
                 </div>";
  return $html_result;
}

function get_ch_pass_hdl(){
  $html_result="<label for=\"old_pass\">请输入原密码：</label><input type=\"password\" name=\"old_pass\"/><span class=\"op_vali\"></span><br/>
          <label for=\"new_pass\">请输入新密码：</label><input type=\"password\" name=\"new_pass\"/><br/>
          <label for=\"new_pass2\">再次输入密码：</label><input type=\"password\" name=\"new_pass2\"/><br/>
          <a>提交更改</a>
          <script type=\"text/javascript\">
              $('ch-pass a').click(function(){
                var requestData={requestV:'changePW',old_pass:$(\"input[name='old_pass']\").val(),
                      new_pass:$(\"input[name='new_pass']\").val(),
                      new_pass2:$(\"input[name='new_pass2']\").val()};
                $.post('usr_info_hdl_re.php',requestData,function(data){
                  $('#handleBlank').html(data);
                });
              });

            $(\"input[name='old_pass']\").blur(function(){
              var requestData={requestV:'vali_old_pass',old_pass:$(\"input[name='old_pass']\").val()};
             $.post('usr_info_hdl_re.php',requestData,function(data){
               $('span.op_vali').html(data);
             });
            });
          </script>
          ";
  // we need to validate simultaneously
  return $html_result;
}

// shop part:
function get_shop_hdl($username){  // better get this to a changeable form
  $conn=new_db_connect();
  $query="select * from shopinfo where userName='".$username."'";
  $result=$conn->query($query);
  if(!$result){
    return "<div>
              <span>您还没有自己的商店呢</span>
              <span><a href=\"/core/shop_create.php\">创建一个吧！</a></span>
            </div>";
  } else {  // till now, we let one user own only one shop
    $result=$result->fetch_assoc();
    $conn->close();
    if($result['shopPhotoId']==0){
      $pic_html="<img src=\"/img/shops/default0.jpg\"/>
                  <span>上传商店的图片</span>";

    } else {
      $pic_html="<img src=\"/img/shops/".$result['shopPhotoId'].".jpg\"/>";
    }
    return "<div class=\"shopid\">您商店的ID:".$result['shopId']."</div>
            <div class=\"shopname\">您商店的名称：".$result['shopName']."</div>
            <div class=\"shoppic\">您商店的图片：$pic_html</div>
            <div class=\"sales\">您卖出的商品总数：".$result['sales']."</div>
            <div class=\"dealer-phoneNo\">您的电话号码：".$result['dealerPhoneNo']."</div>
            <div class=\"dealer-address\">您的地址：".$result['dealerAddr']."</div>
            <div class=\"dealer-email\">您的邮件地址：".$result['dealerEmail']."</div>
            <div class=\"shopdescrip\">您的店铺描述：".$result['shopDescription']."</div>
            <div class=\"dropshop\">
              <button id=\"dropshop\">删除自己的商店</button>
            </div>
            <script type=\"text/javascript\">
              $('#dropshop').click(function(){
                 var confirmation=window.confirm(\"O_O 您确定要删掉自己的商店？\");
                 if(confirmation){
                  var requestData={requestV:'dropshop'};
                  $.post('/core/usr_info_hdl_re.php',requestData,function(data){
                     $('#handleBlank').html(data);
                  });
                 } 
              });
            </script>
           ";
  }
}

function get_shop_dropped($username){
  $conn=new_db_connect();
  $query="delete from shopinfo where userName='".$username."'";
  $result=$conn->query($result);
  if(!$result){
    return " (*>﹏<*) 删不掉您的商店..请稍后再试吧";
  } else {
    $query="update userinfo set shopId=0 where userName='".$username."'";
    $result=$conn->query($result);
    return " ^_^ 成功删掉了您的商店";

  }
}

// order part:
function html_orders_init($result){
  $html_result="";
  $len=count($result);
  if($len==1){
    $html_result="<div class=\"an-order\">
                        <div class=\"orderid\">订单".$result[0]['orderId']."</div>
                        <div class=\"orderDate\">订单时间：".$result[0]['orderDate']."</div>
                        <div class=\"receiptor\">收货人姓名：".$result[0]['receiptor']."</div>
                        <div class=\"address\">收货人地址：".$result[0]['address']."</div>
                        <div class=\"phoneNo\">联系电话：".$result[0]['phoneNo']."</div>
                        <div class=\"postCode\">邮编地址：".$result[0]['postCode']."</div>
                        <div class=\"a-comm\">
                          <div class=\"commTitle\">商品名称：".$result[0]['commTitle']."</div>
                          <div class=\"amount\">商品数量：".$result[0]['amount']."</div>
                          <div class=\"shopName\">店铺名称：".$result[0]['shopName']."</div>
                        </div>
                        <div class=\"payment\">付款额：".$result[0]['payment']."</div>
                    </div>";
  } else {
      // more than one commodity
      $last_orderId=0; // I use this method to get a more readable result since each line in 'orderinfo' stores only one commodity
      $last_payment=0;
      $i=0; #counter
      foreach ($result as $order) {
        if($last_orderId==0){ //initiating
          $last_orderId=$order['orderId'];
          $last_payment=$order['payment'];
          $html_result=$html_result."<div class=\"an-order\">
                        <div class=\"orderid\">订单".$order['orderId']."</div>
                        <div class=\"orderDate\">订单时间：".$result[0]['orderDate']."</div>
                        <div class=\"receiptor\">收货人姓名：".$result[0]['receiptor']."</div>
                        <div class=\"address\">收货人地址：".$result[0]['address']."</div>
                        <div class=\"phoneNo\">联系电话：".$result[0]['phoneNo']."</div>
                        <div class=\"postCode\">邮编地址：".$result[0]['postCode']."</div>
                        <div class=\"a-comm\">
                          <div class=\"commTitle\">商品名称：".$result[0]['commTitle']."</div>
                          <div class=\"amount\">商品数量：".$result[0]['amount']."</div>
                          <div class=\"shopName\">店铺名称：".$result[0]['shopName']."</div>
                        </div>
                      ";
        }else if($last_orderId==$order['orderId']){
          // the same order
          $html_result=$html_result."
                        <div class=\"a-comm\">
                          <div class=\"commTitle\">商品名称：".$result[0]['commTitle']."</div>
                          <div class=\"amount\">商品数量：".$result[0]['amount']."</div>
                          <div class=\"shopName\">店铺名称：".$result[0]['shopName']."</div>
                        </div>
                    ";
          if($i==$len-1){  // done for
              $html_result=$html_result."
                        <div class=\"payment\">付款额：".$order['payment']."</div>
                        </div>
                        "; 
                break;
          }
        } else {
          // another order -- $last_orderId != $order['orderId']
          $last_orderId=$order['orderId'];
          $html_result=$html_result."
                        <div class=\"payment\">$last_payment</div>
                        </div>
                        <div class=\"an_order\">
                        <div class=\"orderid\">订单".$order['orderId']."</div>
                        <div class=\"orderDate\">订单时间：".$result[0]['orderDate']."</div>
                        <div class=\"receiptor\">收货人姓名：".$result[0]['receiptor']."</div>
                        <div class=\"address\">收货人地址：".$result[0]['address']."</div>
                        <div class=\"phoneNo\">联系电话：".$result[0]['phoneNo']."</div>
                        <div class=\"postCode\">邮编地址：".$result[0]['postCode']."</div>
                        <div class=\"a-comm\">
                          <div class=\"commTitle\">商品名称：".$result[0]['commTitle']."</div>
                          <div class=\"amount\">商品数量：".$result[0]['amount']."</div>
                          <div class=\"shopName\">店铺名称：".$result[0]['shopName']."</div>
                        </div>
                      ";
            if($i==$len-1){  // done for
              $html_result=$html_result."
                        <div class=\"payment\">付款额：".$order['payment']."</div>
                        </div>
                        "; 
                break;
            } else {
              $last_payment=$order['payment'];
            }
            
        }
        $i++;
      } // end of 'foreach'
  }
  
  return $html_result;
} # end of function “html_orders_init”

function get_order_hdl_1($username){ // orders not delivered

  $conn=new_db_connect();
  $query="select * from orderinfo where userName='".$username."' && delivery=0 && done=0";
  $result=$conn->query($query);
  if(!$result){
    return "<div>您没有未发货的订单</div>";
  }
  $result=db_result_to_array($result); // an array of associate arrays
  $conn->close(); unset($query);
  if(empty($result))
    return "<div>您没有未发货的订单</div>";
  return html_orders_init($result);
}

function get_order_hdl_2($username){  // orders delivered but not finished
  $conn=new_db_connect();
  $query="select * from orderinfo where userName='".$username."' && delivery=1 && done=0";
  $result=$conn->query($query);
  if(!$result){
    return "<div>您没有已发货但未收货的订单</div>";
  }
  $result=db_result_to_array($result); // an array of associate arrays
  if(empty($result))
    return "<div>您没有已发货但未收货的订单</div>";
  $conn->close(); unset($query);
  return html_orders_init($result);
}

function get_order_hdl_3($username){ // orders finished
  $conn=new_db_connect();
  $query="select * from orderinfo where userName='".$username."' && delivery=1 && done=1";
  $result=$conn->query($query);
  if(!$result){
    return "<div>您没有已完成的订单</div>";
  }
  $result=db_result_to_array($result); // an array of associate arrays
  $conn->close(); unset($query);
  if(empty($result))
    return "<div>您没有已完成的订单</div>";
  return html_orders_init($result);
}

?>