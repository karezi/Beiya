<?php
/*main page*/
	require_once("main.php");				  //µ¼ÈësmartyÅäÖÃºÍÏÔÊ¾·½·¨
	require_once("fclib/beiya_fclib.php");
 		
	session_start();

	/*
	 
	 Here we begin to deal with recoms from friends! whether your buddy wants to or not!
	                   --Morgenstunde hat Gold im Munde!-- 
	*/

	if(@!$SESSION['valid_user']){
		
		//didn't sign in:

		$friend_recom="";

	} else {

		//this guy did sign in:

		$fri_arr=get_fri_names($SESSION['valid_user']);  // this function is in user_func.php
		if(!$fri_arr){

			//if this user doesn't seem to have any friends

			$friend_recom="<div class=\"content2\"> 
  					<div class=\"title\"> <a><img src=\"/img/friendlike.png\"></a> </div>
  					<div>Go get some buds!</div>
  				</div>";
  			unset($fri_arr);

		} else {
			/*	
				so he's got some friends
				now get some favorites of his friends
			*/

			$fri_recom_arr=index_fri_recom($fri_arr);  //we get an array of items recommended; this funcion is in comm_disp_fclib.php

			if(!$fri_recom_arr){

				//if something wrong happend

				$friend_recom="<div class=\"content2\"> 
  					<div class=\"title\"> <a><img src=\"/img/friendlike.png\"></a> </div>
  					<div>Go get some buds!</div>
  				</div>";

			} else {

				//things went smoothly for now!

				$friend_recom="<div class=\"content2\"><div class=\"title\"> 
								<a><img src=\"/img/friendlike.png\"></a> </div>
								<div class=\"lBoxS\">";
				for($i=1;$i<6;$i++){  
					$price_arr=explode(".",$fri_recom_arr[$i]['price']);
					if($i==5){
						$friend_recom="</div>
								<div class=\"bBox\">
       							 <div class=\"gradePic\"> 
       							   <a><img src=\"/img/example.jpg\"></a> 
       							 </div>
   							     <div class=\"InfoBar\">
      							    <div class=\"goodName\">".$fri_recom_arr[5]['commTitle']."</div>
         							<div class=\"price\"><b>￥".$price_arr[0]."</b>.".$price_arr[1]."</div>
      							 </div>
    							</div>";
					}
					else{
						$friend_recom=$friend_recom."<div class=\"lBox".$i."\">
         					 <div class=\"gradePic\"> 
         					 	<a><img src=\"/img/example.jpg\"></a>
         					 </div>
         					<div class=\"InfoBar\">
            					<div class=\"goodName\">".$fri_recom_arr[$i]['commTitle']."</div>
            					<div class=\"price\"><b>￥".$price_arr[0]."</b>.".$price_arr[1]."</div>
          					</div>
        				</div>";
					}
				}
				$friend_recom=$friend_recom."</div>";
			}
			
		}// end of the situation--He indeed has got some friends
	}
  

   // Finished showcasing new items

	$smarty->assign("title","BeiYa Store");  //½øÐÐÄ£°å±äÁ¿Ìæ»» 
	$smarty->assign("header",getHeader());
 	$smarty->assign("footer",getFooter());
	$smarty->assign("navigation",getNavigation());
	$smarty->assign("friend_recom",$friend_recom);

	$smarty->display("index.html");		  //ÏÔÊ¾Ö÷Ò³
?>