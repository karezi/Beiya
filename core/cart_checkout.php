<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../fclib/cart_func.php");
 require("../main.php");

 session_start();

 // initialize $links, a parameter for getHeader()
 $links="";


 if(isset($_SESSION['cart'])&&(array_count_values($_SESSION['cart']))) {
   // if we have stuff on the cart
    // init $cart_info
    $cart_info="<div id=\"show_cart\">
        <table id=\"cart_table\">
          <thead>
            <tr>
              <th>商品名称</th>
              <th>单价</th>
              <th>数量</th>
              <th>总价</th>
            </tr>
          </thead>
          <tbody>";    //the table doesn't end here

    $comms_details=get_cart_comms_details($_SESSION['cart']);  // An array of associate arrays

    // Put the info on!
    $i=0; #counter
    foreach($_SESSION['cart'] as $commid=>$qty){
        $comm_details=$comms_details[$i];   
        $i++;

        $comm_url="/core/show_commodity.php?commid=".$commid;
        $title=$comm_details['commTitle'];
        $photoid=check_photo($comm_details['commPhotoId']); //check if we have a commodity photo;If not, we use a default one
        $price=$comm_details['price'];
         //then add this row to the table of cart_info
        $cart_info=$cart_info.
                  "<tr id=\"".$commid."\">
        						<td><a href=\"".$comm_url."\" class=\"link_pic\">
                     <img src=\"/img/commodity/".$photoid.".jpg\"/></a><br/><a href=\"".$comm_url."\">".$title."</a></td>
                    <td class=\"tb_cartNumber\">".number_format($price,2)."</td>
										 <td id=\"td_qty_".$commid."\" class=\"tb_noneimg1\" align=\"center\">".$qty."</td>
                    <td class=\"tb_cartNumber\">".number_format($price*$qty,2)."</td>   
                    </tr>";  // end of the row 
                     
    }  // end of foreach
    
    $cart_info=$cart_info."</tbofy></table>"."
                   <div class=\"cart_bottom\">
                   		<div class=\"cart_bottom\">
							      <div class=\"leave_message\">
							        <p>
							          <label class=\"fl\">留言：</label>
							          <div id=\"buyer_message\" class=\"fr\"></div>
							        </p>
							      </div>
							      <div class=\"item_total\">
							        <p> 商品总计:￥ <span id=\"cart_item_payment\">".number_format($_SESSION['total_price'],2)."</span> (运费:￥ <span id=\"cart_post_fee\">0</span> ) </p>
							        <p> 总额:￥ <span id=\"cart_payment\" class=\"ft16\">".number_format($_SESSION['total_price'],2)."</span> </p>
							      </div>
			  				  </div>
			  				  </div>"; // the table displaying the cart ends here

    /*
     Parameters via POST method to send to the 'cart_purchase.php'
      are to be specified here:
   'vu_addr'-- if 1, the customer used the first address; if 2, the customer used the second address;
   'new'-- if 1, the customer hasn't got an address before, this one created is his first;
          if 2, the customer has got one before, and this time he created a second.
    */

    
    if($_SESSION['valid_user']) { // if we have a valid user on line
        $receiptorInfo=check_receiptorInfo($_SESSION['valid_user']);  //we got an object here

        //Register the receiptor info to $_SESSION['receiptorInfo'].  
        //Don't know what's that? Check on "Read_cart.txt" !
        $_SESSION['receiptorInfo']['receiptorName']= $receiptorInfo->receiptor;
        $_SESSION['receiptorInfo']['userPhoneNo']=$receiptorInfo->userPhoneNo;
        $_SESSION['receiptorInfo']['userAddr']=$receiptorInfo->userAddr;
        $_SESSION['receiptorInfo']['postCode']=$receiptorInfo->postCode;

        if($_SESSION['receiptorInfo']['userAddr']) {   //if we have an address here 

           $checkout_form=
                              "<div class=\"addr\"> 
                               <table border=\"0\" width=\"100%\" class=\"checkout_form\"> 
                               <tr><th>您的收货信息</th><th> 具体信息</th></tr>
                               <tr><td>收件人姓名</td><td>".$receiptorInfo->receiptor."</td></tr>
                               <tr><td>收件地址</td><td>".$receiptorInfo->userAddr."</td></tr>
                               <tr><td>联系方式</td><td>".$receiptorInfo->userPhoneNo."</td></tr>
                               <tr><td>邮编号码</td><td>".$receiptorInfo->postCode."</td></tr>
                               </table>
															 <div class=\"purchase_confirm\">
                               <form action=\"/core/cart_purchase.php\" method=\"POST\">
                                <a href=\"cart_purchase.php?vu_addr=1\" class=\"purchase_but\"><input type=\"submit\" class=\"Bbutton blue center\" value=\"确定\"/></a>
                                <input type=\"hidden\" name=\"vu_addr\" value=1 />
                               </form> 
                                <a href=\"href=\"/core/cart_show.php\" class=\"purchase_but\"><input type=\"button\" class=\"Bbutton orange center\" value=\"返回\"/></a>
                               </div>   
                              </div>"
                                ;   //How to make POST carry these info?  ;; 2012.11.29 15:56 
                                    //I used a bizarre logic here to carry them! Check on "Read_cart.txt" !
            //and we still need to provide the user a chance to create a new address!

            if(!(empty($receiptorInfo->receiptorSec) or empty($receiptorInfo->userSecAddr))) {  // if he has a second address sheet
              
              $_SESSION['receiptorInfo']['receiptorSecName']= $receiptorInfo->receiptorSec;
              $_SESSION['receiptorInfo']['userSecAddr']=$receiptorInfo->userSecAddr;
              $_SESSION['receiptorInfo']['userSecPhoneNo']=$receiptorInfo->userSecPhoneNo;
              $_SESSION['receiptorInfo']['postcodeSec']=$receiptorInfo->postcodeSec;

              $checkout_form=$checkout_form.     "<div class=\"addr\"> 
                               <table border=\"0\" width=\"100%\" class=\"checkout_form\"> 
                               <tr><th>您的收货信息</th><th> 具体信息</th></tr>
                               <tr><td>收件人姓名</td><td>".$receiptorInfo->receiptorSec."</td></tr>
                               <tr><td>收件地址</td><td>".$receiptorInfo->userSecAddr."</td></tr>
                               <tr><td>联系方式</td><td>".$receiptorInfo->userSecPhoneNo."</td></tr>
                               <tr><td>邮编号码</td><td>".$receiptorInfo->postcodeSec."</td></tr>
                               </table>
															 <div class=\"purchase_confirm\">
                               <form action=\"/core/cart_purchase.php\" method=\"POST\">
                                <a href=\"/core/cart_cart_purchase.php?vu_addr=2\" class=\"purchase_but\"><input type=\"submit\" class=\"Bbutton blue center font_big\" value=\"确定\"/></a>
                                <input type=\"hidden\" name=\"vu_addr\" value=2 />
                               </form>
                                <a href=\"href=\"/core/cart_show.php\" class=\"purchase_but\"><input type=\"button\" class=\"Bbutton blue center font_big\" value=\"返回\"/></a>
                               </div>   
                              </div>"; //How to make POST carry these info? -> The value of 'vu_addr'
            } else {
              /* what if this guy doesn't have a second address,
               but he doesn't want to use the first one?
               Creating a second address     
              */
              $checkout_form=$checkout_form."<br/><form action=\"/core/cart_purchase.php?new=2\" method=\"post\">
                              <table border=\"0\" width=\"100%\" class=\"checkout_form\"> 
                               <tr><th>您的收货信息</th><th> 填写信息</th></tr>
                               <tr><td>收件人姓名</td><td><input type=\"text\" name=\"receiptorname\"/></td></tr>
                               <tr><td>邮编号码</td><td><input type=\"text\" name=\"postcode\"/></td></tr>
                               <tr><td>收件地址</td><td><input type=\"text\" name=\"address\"/></td></tr>
                               <tr><td>联系方式</td><td><input type=\"text\" name=\"phoneno\"/></td></tr>
                              </table>
                               <br/>
                               <div class=\"adrass_confirm\">
                                <input type=\"hidden\" name=\"new\" value=2 />
                                <input type=\"submit\" class=\"Bbutton blue center font_big\" value=\"确定\"/>
                               </div>
                              </form>"; 
            }
  
        }  // end of the situation he have at least one address

        else{  // In case he doesn't have an address
           // we use $_POST['new'] to help cart_purchase.php notice this is a newbie
          $checkout_form="<br/><form action=\"/core/cart_purchase.php\" method=\"post\">
                              <table border=\"0\" width=\"100%\" class=\"checkout_form\"> 
                               <tr><th>您的收货信息</th><th> 填写信息</th></tr>
                               <tr><td>收件人姓名</td><td><input type=\"text\" name=\"receiptorname\"/></td></tr>
                               <tr><td>邮编号码</td><td><input type=\"text\" name=\"postcode\"/></td></tr>
                               <tr><td>收件地址</td><td><input type=\"text\" name=\"address\"/></td></tr>
                               <tr><td>联系方式</td><td><input type=\"text\" name=\"phoneno\"/></td></tr>
                              </table>
                               <br/>
                               <div class=\"adrass_confirm\">
                                <input type=\"hidden\" name=\"new\" value=1 />
                                <input type=\"submit\" class=\"Bbutton blue center font_big\" value=\"确定\"/>
                               </div>
                              </form>
                             ";  
        } 
        
    }  // end of the situation we have a valid user on line

    else{  // if not a valid user
        $checkout_form="<div class=\"mid_div\">
                          <a href=\"/core/usr_login.php\"> <div class=\"Bbutton blue\">登录</div></a>
                          <a href=\"/core/usr_register_new.php\"><div class=\"Bbutton orange\">注册</div></a><br/>
                        </div>";
    }
 } else { // the cart is empty
    $cart_info="<div style=\" color:#3c00ff; font-size:30px; font-family:times; text-align:center; width:100% \">
            There's nothing in your cart... Go and get some good stuff for yourself or your people!
          </div>";
    $checkout_form="";
 }

 // displaying the page
 
 $links="<div class=\"header_lnks\">
           <a href=\"/index.php\"> Go to Main Page </a>&nbsp;&nbsp;&nbsp;
           <a href=\"/core/cart_show.php\"> Back to Shopcart </a>
         </div><br/>";

 $head_content=getHead_content();
 $header=getHeader();
 $footer=getFooter();
 $smarty->assign("navigation",getNavigation());
 $smarty->assign("header",$header);
 $smarty->assign("footer",$footer);
 $smarty->assign("cart_info",$cart_info);
 $smarty->assign("checkout_form",$checkout_form);
  $smarty->assign("links",$links);


 $smarty->display("cart_checkout.html");

?>