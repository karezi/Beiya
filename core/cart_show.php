<?php
 require("../main.php");
 require_once("../fclib/beiya_fclib.php");
 require_once("../fclib/cart_func.php");
 
 //We don't check if it's a valid user going shopping now, wait till the person tries to order
 session_start();

  $links="";

 @ $newcomm_id=$_GET['newcomm_id'];
 if ($newcomm_id) { //Something new has been put into it
 	if(!isset($_SESSION['cart']))  
 	{   //$_SESSION['cart'] works as an array storing the quantity of each commodity
        //the index of the array is its commId  
 		$_SESSION['cart']=array();
 		$_SESSION['items']=0;
 		$_SESSION['total_price']='0.00';
 	}
 	if(isset($_SESSION['cart'][$newcomm_id]))
 	{
 		$_SESSION['cart'][$newcomm_id]++;
 	} else{
 		$_SESSION['cart'][$newcomm_id]=1;
 	}

 	$_SESSION['total_price']=calculate_price($_SESSION['cart']);
 	$_SESSION['items']=calculate_items($_SESSION['cart']);
 } //the big "if" of "if ($newcomm_id)"//Something new has been put into it 
 

 	if(isset($_POST['save']))  
 	{   //we use $_POST['save'] to flag the change and save of the cart
 	    //this part of script is to process the change of the cart

 		foreach($_SESSION['cart'] as $commid=>$qty)
 		{ 
 			if($_POST[$commid]=='0'){
 				unset($_SESSION['cart'][$commid]);
 			} else{
 				$_SESSION['cart'][$commid]=$_POST[$commid];
 			}
 		}  //the loop ends here  
 		
 		//after checking the state_change, we calculate again and put it out
 	    $_SESSION['total_price']=calculate_price($_SESSION['cart']);
 	    $_SESSION['items']=calculate_items($_SESSION['cart']);
 	}
  
  if(@ $_GET["cateid"]){
      $cont_shop_url="/core/show_category.php?cateid=".$_GET["cateid"];
  } else{
      $cont_shop_url="/core/show_category.php"; 
  }

 	
    
    
    if((@$_SESSION['cart']) && array_count_values($_SESSION['cart']))   //We try to display the cart here 
    {
        $_SESSION['total_price']=calculate_price($_SESSION['cart']);
        $_SESSION['items']=calculate_items($_SESSION['cart']);

       //use a table to display the cart; now here's the first part
    $cart_block1="  
    <form action=\"/core/cart_show.php\" method=\"post\">
    <div id=\"show_cart\">
    <table id=\"cart_table\">
      <thead>
        <tr>
          <th>商品名称</th>
          <th>单价</th>
          <th>数量</th>
          <th>总价</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>";

    $comms_details=get_cart_comms_details($_SESSION['cart']);  // An array of associate arrays

    $i=0; #counter
    //after the head, we display each item in the cart as a table row
    foreach( $_SESSION['cart'] as $commid=>$qty){

        $comm_details=$comms_details[$i];   
        $i++;  

        $comm_url="/core/show_commodity.php?commid=".$commid;
        $title=$comm_details['commTitle'];
        $photoid=check_photo($comm_details['commPhotoId']); //check if we have a commodity photo;If not, we use a default one
        $price=$comm_details['price'];
        $cart_block1=$cart_block1."<tr id=\"".$commid."\">
        						<td><a href=\"".$comm_url."\" class=\"link_pic\">
                     <img src=\"/img/commodity/".$photoid.".jpg\"/></a><br/><a href=\"".$comm_url."\">".$title."</a></td>
                    <td class=\"tb_cartNumber\">".number_format($price,2)."</td>
                    <td id=\"td_qty_".$commid."\" class=\"comm_count\">             
               	      <input class=\"cart_min\" type=\"button\" name=\"\" value=\"-\" />
          				    <input class=\"td_qty_\" type=\"text\" name=\"".$commid."\" value=\"".$qty."\" />
          				    <input class=\"cart_add\" type=\"button\" name=\"\" value=\"+\" />
                    <td class=\"tb_cartNumber\">".number_format($price*$qty,2)."</td>   
                    <td class=\"tb_handle\"><input class=\"button blue btn-medium\" type=\"submit\" value=\"删除\"></td> 
                    </tr>";  //Need ajax here
                     
    }
    $cart_block1=$cart_block1."</tbody></table></div>";
    $cart_changeblock="
    								<div class=\"cart_bottom\">
							      <div class=\"leave_message\">
							        <p>
							          <label class=\"fl\">留言：</label>
							          <textarea id=\"buyer_message\" class=\"fr\"></textarea>
							        </p>
							      </div>
							      <div class=\"item_total\">
							        <p> 商品总计:￥ <span id=\"cart_item_payment\">".number_format($_SESSION['total_price'],2)."</span> (运费:￥ <span id=\"cart_post_fee\">0</span> ) </p>
							        <p> 总额:￥ <span id=\"cart_payment\" class=\"ft16\">".number_format($_SESSION['total_price'],2)."</span> </p>
							      </div>
			  				  </div>
    									<div class=\"cart_changeblock\">
                      <input type=\"submit\" class=\"button blue\" name=\"save\" value=\"保存\"/>
                      <a href=\"./cart_checkout.php\"><input type=\"\" value=\"提交订单\" class=\"pay pay_ad button red\" id=\"cart_submit\" ></a>
                      
                      </div></form>"; //the form ends here
    $cart_endblock="<hr/><div class=\"cart_endblock\"><p>您一共有 <span id=\"id=\"item_num\"\">".$_SESSION['items']."</span>件商品</p>
                   <p>总价:<span id=\"total_price\">".number_format($_SESSION['total_price'],2)."</span></p>
                   </div>";
    }
    else{   
        $cart_block1="<div class=\"hint hint_cart_empty\"></div>";
        $cart_changeblock="";
        $cart_endblock="";
    }

    $smarty->assign("show_cart_block1",$cart_block1);
    $smarty->assign("show_cart_changeblock",$cart_changeblock);
    $smarty->assign("show_cart_endblock",$cart_endblock);

    $links="
                      <a href=\"".$cont_shop_url."\"><div class=\"Bbutton font_big blue center\">继续逛逛</div></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      </div>";
    $head_content=getHead_content();
    $header=getHeader();
    $footer=getFooter();
    
     $smarty->assign("links",$links);
    
    $smarty->assign("title","Check your shooping cart ---- BeiYa Store");
    $smarty->assign("head_content",$head_content);
    $smarty->assign("header",$header);
    $smarty->assign("navigation",getNavigation());
    $smarty->assign("footer",$footer);

    $smarty->display("cart_show.html");

?>