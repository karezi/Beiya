<?php
function calculate_price($cart){
  //sum total price for all items in shopping cart
  $price=0.00;
  if (is_array($cart))
   {
    $conn=new_db_connect();
    foreach($cart as $commid=>$qty)
    { 
    	$query="select price from commInfo where commId='".$commid."'";
        $result=$conn->query($query);
	    if ($result)
	    { 
	      $item=$result->fetch_object();
	      @$item_price=$item->price;
	      $price+=$item_price*$qty;
	    }
    } //the loop ends

   }
 return $price;
}

function calculate_items($cart){
  //sum total items in shopping cart
  $items=0;
  if(is_array($cart))
   { 
   	  foreach($cart as $isbn=>$qty)
      { 
      	$items+=$qty;
      } //the loop ends
   }
  return $items;
}

function add_receiptor_info($add_flag,$username,$receiptor,$postcode,$address,$phoneno){  //use this function to put a new receiptor info into the database
 
 $conn=new_db_connect();
 
 switch ($add_flag) {
   case 'no':  // The user has no address
     $query="update userInfo set receiptor='".$receiptor."', postCode='".$postcode."',userAddr='".$address."',userPhoneNo='".$phoneno."'
         where userName='".$username."'";
     break;
   case 'one': // The user has a address
     $query="update userInfo set receiptorSec='".$receiptor."',postcodeSec='".$postcode."',userSecAddr='".$address."',userSecPhoneNo='".$phoneno."'
         where userName='".$username."'";
     break;
   case 'two':  // The user has two address
     break;
   default:
     break;
 }
  
 $result=$conn->query($query);

 if(!$result){
  return false;
 } else return true;

}
 
// A very important function here!  Used throughout the process
function get_cart_comms_details($cart){  // cart indicates $_SESSION['cart']
// To avoid extracting data from db for several times, here I get the all details out

  $query="select * from comminfo where "; 
    $i=0; # counter
    foreach($cart as $commid=>$qty){
      if($i!=count($cart)-1){
        $query=$query." commId=".$commid." or ";
      } else {
        $query=$query." commId=".$commid;
      }
      $i++;
    }
    $conn=new_db_connect();
    $results=$conn->query($query);
    unset($i,$query);  
    $comms_details=db_result_to_array($results);  // An array of associate arrays
  return $comms_details;
}

?>

