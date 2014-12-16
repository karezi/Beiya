<?php
 require("../main.php");
 require_once("../fclib/beiya_fclib.php");
 require_once("../fclib/cart_func.php");
 require("../fclib/security.php");

 session_start();
 
 /*
  Firstly, parameters via GET method are to be specified here:
  'vu_addr'-- if 1, the customer used the first address; if 2, the customer used the second address;
  'new'-- if 1, the customer hasn't got an address before, this one created is his first;
          if 2, the customer has got one before, and this time he created a second.
*/
 $main_block="";

 if(isset($_SESSION['valid_user'])) {  // a valid user on line

    if(@isset($_POST['vu_addr']) && isset($_SESSION['valid_user']) && !isset($_POST['new'])) {   
      // If we got a valid user with address here  # Beginning of Main logic branch 1 

      //there's a minor logic diversion here:
   		if($_POST['vu_addr']==1)   //The customer used the first address
   		{
			$_SESSION['receiptorInfo']['receiptorname']=$_SESSION['receiptorInfo']['receiptorName'];
   		$_SESSION['receiptorInfo']['address']=$_SESSION['receiptorInfo']['userAddr'];
			$_SESSION['receiptorInfo']['phoneno']=$_SESSION['receiptorInfo']['userPhoneNo'];
			$_SESSION['receiptorInfo']['postcode']=$_SESSION['receiptorInfo']['postCode'];

			unset($_SESSION['receiptorInfo']['receiptorName'],$_SESSION['receiptorInfo']['userAddr'],
              $_SESSION['receiptorInfo']['userPhoneNo'],$_SESSION['receiptorInfo']['postCode']);
   		}
   		if($_POST['vu_addr']==2)  //The customer used the second address
   		{
			$_SESSION['receiptorInfo']['receiptorname']=$_SESSION['receiptorInfo']['receiptorSecName'];
   		$_SESSION['receiptorInfo']['address']=$_SESSION['receiptorInfo']['userSecAddr'];
			$_SESSION['receiptorInfo']['phoneno']=$_SESSION['receiptorInfo']['userSecPhoneNo'];
			$_SESSION['receiptorInfo']['postcode']=$_SESSION['receiptorInfo']['postcodeSec'];

			unset($_SESSION['receiptorInfo']['receiptorName'],$_SESSION['receiptorInfo']['userAddr'],
              $_SESSION['receiptorInfo']['userPhoneNo'],$_SESSION['receiptorInfo']['postCode'],
              $_SESSION['receiptorInfo']['receiptorSecName'],$_SESSION['receiptorInfo']['userSecAddr'],
              $_SESSION['receiptorInfo']['userSecPhoneNo'],$_SESSION['receiptorInfo']['postcodeSec']);
   		}

   		$main_block="<div class=\"confirm_info\">
                       <span>姓名:&nbsp;".$_SESSION['receiptorInfo']['receiptorname']."</span><br/>
                       <span>联系电话:&nbsp;".$_SESSION['receiptorInfo']['phoneno']."</span><br/>
                       <span>地址:&nbsp;".$_SESSION['receiptorInfo']['address']."</span><br/>
                       <span>邮编:&nbsp;".$_SESSION['receiptorInfo']['postcode']."</span><br/>
                      </div>";

 	} // end of Main Logic branch 1 -- The user used the addresses he has owned.
  
	else if(@ isset($_POST['new']) && isset($_SESSION['valid_user']) && !isset($_POST['vu_addr'])) {
   //If this is true, the user used a newly created address  
	   
        //Main logic branch 2:

	   if(isset($_POST['receiptorname'])&& isset($_POST['postcode'])
	   	  && isset($_POST['address'])&&isset($_POST['phoneno'])) {   
	   	  //if the form is completed

             $receiptorname=str_check($_POST['receiptorname']);
             $postcode=str_check($_POST['postcode']);
             $address=str_check($_POST['address']);
             $phoneno=str_check($_POST['phoneno']);
			
          // There comes another minor logic diversion:      
          // 'new'->1  :  No address before
             if($_POST['new']==1){
                //#   if($receiptorname==$_SESSION['valid_user']){  // if the receiptorname is the user logged on 
                                                         // real-name system?   
               $add_flag=check_exist_address($_SESSION['valid_user']);  //f10 in data_check.php
               // this tells the function "add_receiptor_info" if the user already have an address

              add_receiptor_info($add_flag,$_SESSION['valid_user'],$receiptorname,$postcode,$address,$phoneno);
               /* 
                  use this function to put a new receiptor info into the database;
                  we use $add_flag to indicate if the user owns an address before
               */
         //#    }
             } else if($_POST['new']==2){

				          $add_flag=check_exist_address($_SESSION['valid_user']);  

				          add_receiptor_info($add_flag,$_SESSION['valid_user'],$receiptorname,$postcode,$address,$phoneno);
                                    
             } else {
              // In case some smart axx tries to play with us 
                echo "<div style=\"display:none\"><font size=\"20\">Don't mess with us, dude!</font>
                            <script type=\"text/javascript\">
                              setTimeout(function(){
                                window.location.href(\"/index.php\");
                              },1000);
                            </script>
                      </div>";

             }

          
             
             // these session variables are stored to be used for the order
             $_SESSION['receiptorInfo']['receiptorname']=$receiptorname;
             $_SESSION['receiptorInfo']['postcode']=$postcode;
             $_SESSION['receiptorInfo']['address']=$address;
             $_SESSION['receiptorInfo']['phoneno']=$phoneno;

             unset($receiptorname,$postcode,$address,$phoneno);

             $main_block="<div class=\"confirm_info\">
 		                   <span>Name:&nbsp;".$_SESSION['receiptorInfo']['receiptorname']."</span><br/>
 		                   <span>Phone Number:&nbsp;".$_SESSION['receiptorInfo']['phoneno']."</span><br/>
 		                   <span>Address:&nbsp;".$_SESSION['receiptorInfo']['address']."</span><br/>
 		                   <span>Post Code:&nbsp;".$_SESSION['receiptorInfo']['postcode']."</span><br/>
 		                  </div>";
          
	   } else { // the form is not completed
	   	   echo "<div style=\"display:none\">
          <script type=\"text/javascript\">
            alert(\"Your form is not completed!\");
            setTimeout(function(){
                                window.location.href(\"/core/cart_checkout.php\");
                              },500);
          </script>
          </div>";
	   	   exit();
	   }

	 } //end of Main logic branch 2 -- The user used a newly created address

 }  // end of the situation --- a valid user on line

 else{//  Not a valid user 
 	echo "<div style=\"display:none\"><script type=\"text/javascript\">
          alert(\"Please log in to buy stuff on BeiYa!\");
          setTimeout(function(){
                                window.location.href(\"/core/usr_login.php\");
                              },500);
        </script></div>";
	exit();
 }
 
 // we provide several choices
  
  // at first we get some info of each commodity in the cart for the customer to see

 $comms_details=get_cart_comms_details($_SESSION['cart']);

  $choices="<br/><div class=\"commnames\">";

  $i=0;  #counter
  foreach ($_SESSION['cart'] as $commid => $qty) {
 	  $commname=$comms_details[$i]['commTitle'];
    $price=$comms_details[$i]['price'];
    $i++;
    $choices=$choices."<div>
                       ".$commname."&nbsp;&nbsp;
                       ".$qty."&nbsp;&nbsp;
                       ￥".$price."
                      </div><br/>";
  }
 $choices=$choices."</div>";

 $choices=$choices."<div class=\"cho_lnks\">
                      <form action=\"cart_confirm.php\" method=\"POST\">
                        <div style=\"display:none\">
                          <input type=\"hidden\"/ name=\"kk1a\" value=\"opine\">
                        </div>
                        <input type=\"submit\" value=\"Confirm and pay\">
                      </form>
                      <a href=\"/core/cart_checkout.php\">Back to checkout</a>
                    </div>";

  // displaying the page
 $links="<a href=\"/index.php\"> Go to Main Page </a>&nbsp;&nbsp;&nbsp;
           <a href=\"/core/cart_show.php\"> Back to Shopcart </a>";
 $head_content=getHead_content();

 $header=getHeader();
 $footer=getFooter();

 $links=$links.$choices;

 $smarty->assign("header",$header);
 $smarty->assign("footer",$footer);
 $smarty->assign("main_block",$main_block);
 $smarty->assign("links",$links);
 $smarty->assign("navigation",getNavigation());
 $smarty->display("purchase.html");
?>