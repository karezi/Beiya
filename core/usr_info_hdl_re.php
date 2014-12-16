<?php

require_once("../fclib/db_func.php");
require_once("../fclib/user_func.php");

if(isset($_POST['requestV'])){
	session_start();
	switch ($_POST['requestV']) {
		//usr-info part:
		case 'own_info':
			echo "<div class=\"own-info-hdl\">",get_own_info_hdl($_SESSION['valid_user']),"</div>";
			break;
		case 'ch_pass':
			echo "<div class=\"ch-pass\">",get_ch_pass_hdl(),"</div>";
			break;
		//usr-info part ends.

		//shop part:
		case 'shop_hdl':
			echo "<div class=\"shop-hdl\">",get_shop_hdl($_SESSION['valid_user']),"</div>";
			break;
		case 'dropshop':
			echo "<div class=\"drop-shop\">",get_shop_dropped($_SESSION['valid_user']),"</div>";
			break;
		//shop part ends.

		//order part:
		case 'ohdl_1':  // orders not delivered
			echo "<div class=\"order-hdl\">",get_order_hdl_1($_SESSION['valid_user']),"</div>";
			break;
		case 'ohdl_2': // orders delivered but not finished
			echo "<div class=\"order-hdl\">",get_order_hdl_2($_SESSION['valid_user']),"</div>";
			break;
		case 'ohdl_3': // orders finished
			echo "<div class=\"order-hdl\">",get_order_hdl_3($_SESSION['valid_user']),"</div>";
			break;
		//order part ends.

		//changing password part:
		case 'changePW':// receiving password changing data
			if(@ $_POST['old_pass']&&$_POST['new_pass']&&$_POST['new_pass2']){
				switch (checknchangePWs($_POST['old_pass'],$_POST['new_pass'],$_POST['new_pass2'],$_SESSION['valid_user'])){ //this function is in data_check.php
					case 'op_wr': 
						# old_pass wrong
						echo "<div>请检查您的密码".get_ch_pass_hdl()."</div>";
						break;
					case 'dontmatch':
						# new passes don't match
						echo "<div>两次密码不一致".get_ch_pass_hdl()."</div>";
						break;
					case 'invalid':
						# nwe pass invalid
						echo "<div>新的密码无效".get_ch_pass_hdl()."</div>";
						break;
					case 'db_failure':
						echo "<div>（＞﹏＜） Sorry, it seems there are something wrong with our server..
						Please try it again.".get_ch_pass_hdl()."</div>";
						break;
					case 'success':
						echo "<div>您成功地修改了密码！ O(∩_∩)O~~</div>";
						break;
					default:
						echo "<div>（＞﹏＜） Sorry, it seems there are something wrong with our server..
						Please try it again.</div>";
						break;
				} 
					
			} else {
				echo "<div>请将表单填写完整：".get_ch_pass_hdl()."</div>";
				}
			break;

		case 'vali_old_pass':
			try{
				if(check_passwd($_SESSION['valid_user'],$_POST['old_pass'])){  // this function in 'data_check.php'
					// it's a right password
					echo "yes";
				} else {
					// not the right password
					echo "no";  //better change this into .icos
				}
			} catch(Exception $e){
				echo "<div>It seems you're playing with fire.
						Please don't do it again.</div>";
			}
			break;
			//changing password part ends. 

		default:
			//这里打个水印好了
			echo "<div><h1>我是水印</h1></div>";
			break;
	}
} else {
	echo "<div style=\"text-align: center;\"><h1>Yo!</h1></div>";
}
	
?>