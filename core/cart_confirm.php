<?php
 require("../main.php");
 require_once("../fclib/beiya_fclib.php");
 require_once("../fclib/cart_func.php");

 

 if(@ $_POST['kk1a']=="opine"){

  session_start();

  $main_block="<div class=\"cf_title\">
                Confirm your order
              </div><br/>
              <div class=\"comms\">";

// we get some info of each commodity in the cart for the customer to see
 $comms_details=get_cart_comms_details($_SESSION['cart']);

 $i=0;  # counter
 foreach ($_SESSION['cart'] as $commid => $qty) {
  $commname=$comms_details[$i]['commTitle'];
  $i++;

  $main_block=$main_block."<div>".$qty."&nbsp;<a href=\"/core/show_commodity.php?commid="
                          .$commid."\">".$commname."</a>
                          </div><br/>";
  }


 $main_block=$main_block."</div>
              <div class=\"confirm_info\">
            <span>Name:&nbsp;".$_SESSION['receiptorInfo']['receiptorname']."</span><br/>
            <span>Phone Number:&nbsp;".$_SESSION['receiptorInfo']['phoneno']."</span><br/>
            <span>Address:&nbsp;".$_SESSION['receiptorInfo']['address']."</span><br/>
            <span>Post Code:&nbsp;".$_SESSION['receiptorInfo']['postcode']."</span><br/>
            <span>
              <form action=\"/core/cart_finish.php\" method=\"post\">
                <div style=\"display:none\">
                 <input type=\"hidden\" name=\"confirm1\" value=\"kiddingL7\"  />
                 <input type=\"hidden\" name=\"confirm2\" value=\"wakaka\"  />
                </div>
                <input type=\"hidden\" name=\"confirm3\" value=\"v8o6\"  />
                <input type=\"submit\" value=\"Confirm\"/>
              </form>
            </span>
          </div>";

 // displaying the page
 $main_block=$main_block."<br/><div><a href=\"/index.php\"> Go to Main Page </a>&nbsp;&nbsp;&nbsp;
           <a href=\"/core/cart_show.php\"> Back to Shopcart </a></div>";

 $head_content=getHead_content();
 $header=getHeader();
 $footer=getFooter();

 $smarty->assign("header",$header);
 $smarty->assign("footer",$footer);
 $smarty->assign("main_block",$main_block);

 $smarty->display("cart_confirm.html");

 } else {
  echo "<div type=\"display:none\">
          <script type=\"text/javascript\">
               window.location.href(\"/core/cart_checkout.php\");
          </script>
        </div>";
 }
 
 
?>