<?php
//part1 basic html functions
function getHead_content(){  // Contents in <head></head>  like <meta> and "<link rel="Shortcut Icon" href="xx.ico" type="image/x-icon">"
  $head_content="<link rel=\"Shortcut Icon\" href=\"shortcut.ico\" type=\"image/x-icon\"/>
                 <link rel=\"icon\" href=\"fav.ico\" type=\"image/x-icon\"/>";
  return $head_content;
}

function getHeader(){
	if(isset($_SESSION['admin_user'])){
		$links="<a href=\"/admin/admin.php\" class=\"usr_links\">Administration Page</a><br/>
				<a href=\"/admin/admin_logout.php\" class=\"usr_links\">Log out here</a><br/>";
	} else{

    if(!isset($_SESSION['valid_user']))
    { 
     $links="
	 <a href=\"/core/usr_register_new.php\"><div class=\"register\">注册</div></a>
	 <a href=\"/core/usr_login.php\"><div class=\"login\">登录</div></a>
	 <a href=\"/core/cart_show.php\"><div class=\"user\">购物车</div></a>

     	";
    }
    else{
     $links="
	   <a href=\"/core/usr_logout.php\"> <div class=\"register\">登出</div></a>
     <a href=\"/core/cart_show.php\"><div class=\"user\">购物车</div></a>
     <a href=\"/core/usr_info_handle.php\"><div class=\"user\">设置</div></a>
     <a href=\"/core/shop_admin.php\"><div class=\"user\">我的商店</div></a>
	   <a href=\"/core/friends_main.php\"><div class=\"user\">好友</div></a>
	   <a href=\"/core/friends_favorite_shops.php\"><div class=\"user\">关注</div></a>
	   <a href=\"/core/friends_msg.php\"><div class=\"user\">消息</div></a>

	";
    }
 }
  $header="
  <div class=\"content\">
    <div class=\"logo1\"> <a href=\"/index.php\"> <img src=\"/img/logo1.jpg\"></a>

    </div>".$links."</div>";
  return $header;
}

function getNavigation(){
	$navigation="
	<div id=\"navigation1\">
  	<div class=\"logo2\"> <img  border=\"0\" usemap=\"#Map\" src=\"/img/logo2.jpg\" />
 		</div>
 	 <div id=\"Info\">
		  <ul>
		  <li></br></li>    
		  <a><li class=\"tag\" id=\"index_goods\">商品 </li></a>    
		  <a><li class=\"\" id=\"index_shops\">店家</li></a>
		  </ul>
		</div>
	  <div class=\"search\">
	    <form id=\"SearchForm\" action=\"\" name=\"search\" target=\"_blank\">
	      <input id=\"SearchQuery\" class=\"searchTxt\" autocomplete=\"off\" autofocus=\"true\" name=\"q\" accesskey=\"s\" value=\"请输入关键字\">
	      <button class=\"search-btn\" type=\"submit\">搜    索</button>
	    </form>
	  </div>
  </div>
  <div id=\"navigation2\">
  	<div id=\"categoryDetail\">
  		<div id=\"detailLeft\"class=\"hide\">dd</div>
  		<div id=\"detailMid\"class=\"\">
  			<ul>
		  	<li><div><img src=\"/img/index_icon.png\"></img></div><div><a href=\"/core/show_category.php?cateid=1\">第一类</a> <a href=\"h2h\">第二类</a> </br><a href=\"h3h\">第三类</a> <a href=\"h4h\">第四类</a></div></li>    
				<li><div><img src=\"/img/index_icon.png\"></img></div><div><a href=\"h1h\">第一类</a> <a href=\"h2h\">第二类</a> </br><a href=\"h3h\">第三类</a> <a href=\"h4h\">第四类</a></div></li> 
				<li><div><img src=\"/img/index_icon.png\"></img></div><div><a href=\"h1h\">第一类</a> <a href=\"h2h\">第二类</a> </br><a href=\"h3h\">第三类</a> <a href=\"h4h\">第四类</a></div></li> 
				<li><div><img src=\"/img/index_icon.png\"></img></div><div><a href=\"h1h\">第一类</a> <a href=\"h2h\">第二类</a> </br><a href=\"h3h\">第三类</a> <a href=\"h4h\">第四类</a></div></li> 
		  	</ul>
		  </div>
		  <div id=\"detailRight\"class=\"hide\">sss</div>
  	</div>
  	
  </div>
	
	";
	return $navigation;
}

function getFooter(){
  $footer="<div id=\"footer\">
  <p>关于我们 | 联系热线 | 广告刊例 | 帮助HELP | 法律条款 | 意见反馈<br />
    Copyright 2001-2012 Chinavisual.com Incorporated. All rights reserved. </p>
</div>";
  return $footer;
}



function display_button($url,$button_name){
   echo "<a href=\"".$url."\" class=\"general_button\">".$button_name."</a>";
}

function show_site_header($title)
 {
?>
  <html>
  <head>
  	<title><?php echo $title; ?></title>
  </head>
  <body>
  	<h2>Header</h2>
<?php
 }

 function show_url($url,$url_show)  //$url_show means the name of the anchor showed on the web
 {
   echo "<a href=\"".$url."\">".$url_show."</a><br/>";
 }

 function show_site_footer()
 {
 ?>
   <div><h3>Footer</h3></div> 
   </body>
   </html>
 <?php
 }


//part2 form displaying functions
 function get_Html_loginForm(){
   $loginForm="<h3>登录</h2>
    <div class=\"login-list\">
      <form id=\"loginForm\" method=\"post\" action=\"/core/usr_login.php\" method=\"post\" name=\"login\">
        <div><span>
          <label>姓名</label>
          </span>
          <input  type=\"text\" id=\"username\" name=\"username\"/>
        </div>
        <div><span>
          <label>密码</label>
          </span>
          <input type=\"password\" id=\"password\" name=\"password\"/>
        </div>
        <div id=\"confirm\">
          <button class=\"Bbutton blue\" type=\"submit\" value=\"Submit\">登录</button>
        </div>
      </form>
    </div>
  </div>";
   return $loginForm;
 }

 function get_Html_regiForm(){
  $regiForm=" 
    <div class=\"register-list\">
      <form id=\"registerForm\" method=\"post\" action=\"/core/usr_register_new.php\" method=\"post\" name=\"register\">

        <div class=\"form-item\"><span>
          <label>姓名：</label>
          </span>
          <input  type=\"text\" id=\"username\" name=\"username\"/>
          <div class=\"register_info hide\">
          	<i></i><div id=\"username_info\">请输入您的姓名</div>
          </div>
        </div>
        <div class=\"form-item\"><span>
          <label>登录密码：</label>
          </span>
          <input type=\"password\" id=\"password\" name=\"password\"/>
          <div class=\"register_info hide\">
          	<div id=\"password_info\">6—16个字符，不含特殊符号</div>
          </div>
        </div>
        <div class=\"form-item\"><span>
          <label>重复密码：</label>
          </span>
          <input type=\"password\" id=\"password2\" name=\"password2\"/>
          <div class=\"register_info hide\" >
          	<i></i><div id=\"password2_info\">请重复密码</div></div>
        	</div>
        <div class=\"form-item\"><span>
          <label>Email：</label>
          </span>
          <input  type=\"text\" id=\"email\" name=\"email\"/>
          <div class=\"register_info hide\" \><div id=\"email_info\">请填写邮箱地址</div></div>
          <div id=\"email_suggestion\"></div>
        </div>
        <div class=\"form-item\" id=\"confirm\">
          <button id=\"register_confirm\" class=\"Bbutton blue\" type=\"submit\" value=\"Submit\">注册</button>
        </div>
      </form>
    </div>
  </div>"
             
             ;
  return $regiForm;
 }
  function display_registration_form(){
?>
   <form action="/core/usr_register_new.php" method="post">
   <label for="email">Email:</label>
       <input type="text" id="email" name="email" /><br/>
       
   <label for="username">Username:</label>
       <input type="text" id="username" name="username" /><br/>
       
   <label for="password">Password:</label>
       <input type="password" id="password" name="password" /><br/>
       
   <label for="password2">Retype your password:</label>
       <input type="password" id="password2" name="password2" /><br/>  
   <input type="submit" value="Submit" />          
  </form>
<?php
}
 function jump_with_alert($info, $url) {
?>

<!--insert html-->
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>loading</title>
</head>

<body>
<!--	<center>
	<span style="font-family:'Courier New', Courier, monospace">
	please click <a href="<?php echo $url ?>">here </a>to return.
	</span>
	</center>
-->
<script type="application/javascript" language="javascript">
alert("<?php echo $info?>");
window.location.href = "<?php echo $url ?>";
</script>
</body>

<?php
	exit();
}
?>
<?php

function get_fillshopinfo_form(){
	
	$fillshopinfo_form="
	<div id=\"fillForm\">
	<h3>商店信息</h3>
	<form id=\"fill\" name=\"fill\" method=\"post\" action=\"/core/shop_fill.php\"  enctype=\"multipart/form-data\">
	<p><span>商店名称:</span>
	<input id=\"author\" name=\"shopName\" type=\"shopName\" /></p>
	<p><span>商店Logo</span>:
	<input id=\"shopPhoto\"  name=\"shopPhoto\" type=\"file\" /></p>
	<p><span>联系电话:</span>
	<input id=\"dealerPhoneNo\" name=\"dealerPhoneNo\" type=\"text\" /></p>
	<p><span>联系地址:</span>
	<input id=\"dealerAddr\" name=\"dealerAddr\" type=\"text\" /></p>
	<p><span>联系邮箱:</span>
	<input id=\"dealerEmail\" name=\"dealerEmail\" type=\"text\" /></p>
	<p><span>商店描述:</span></p>
	<textarea id=\"shop-describe\" name=\"shop-describe\" cols=\"50\" rows=\"5\"></textarea><br />	
	<input class=\"button blue\"type=\"submit\" name=\"submit\" value=\"提交\" />
	</form></div>";
	return $fillshopinfo_form;
}
 function get_orderForm_form($shopId){
	$rows = get_goods($shopId);
		$orderForm="
		
		<h3>用户订单</h3>
		<div id=\"orderForm\">
		<table>
			<thead>
				<tr>
					<th>订单编号</th>
					<th>商品编号</th>
					<th>商品图片</th>
					<th>购买数量</th>
					<th>支付金额</th>
					<th>交易地址</th>
					<th>预留电话</th>
					<th>订单状态</th>
					<th>操作</th>
				</tr>
			</thead>
		<tbody>";
		for($i = 0; $i < count($rows); $i++){
			$orderForm=$orderForm.
			"
				<tr>
					<td>".$rows[$i]['orderId']."</td>
					<td>".$rows[$i]['commId']."</td>
					<td><img src=\"/upload/".$rows[$i]['commId'].".jpg\"></></td>
					<td>".$rows[$i]['number']."</td>
					<td>".$rows[$i]['price']."</td>
					<td>".$rows[$i]['address']."</td>
					<td>".$rows[$i]['phonenumber']."</p></td>
					<td>".$rows[$i]['state']."</td>
					<td>".$rows[$i]['operate']."</td>";
					
		}
		$orderForm=$orderForm."</tbody></table></div>";
	return $orderForm;
 }
function get_shopinfo_form($row){

	 $shopInfoHandle_disp="
	 <div id=\"shop_handle\">
	 <div class=\"Bbutton blue font_big\">店铺信息</div>
	 <a href='/core/shop_goods_show.php'><div class=\"Bbutton orange font_big\">商品仓库</div></a>
	 <a href='/core/shop_orderForm_show.php'><div class=\"Bbutton orange font_big\">店铺订单</div></a>
	 <a href='/core/shop_goods_upload.php'><div class=\"Bbutton orange font_big\">添加商品</div></a>
	 </div>
	 <div id=\"InfoForm\"><h3>店铺信息：</h3><div id=\"shopInfo\">
	 <table id=\"shopInfoTable\">
	 <tr><td>店铺名称：</td><td>".$row['shopName']."</td> </tr>
	 <tr><td>店铺编号：</td><td>".$row['shopId']." </td></tr>
	 <tr><td>店铺销量：</td><td>".$row['sales']."</td></tr>
	 <tr><td>店铺联系方式：</td><td>".$row['dealerPhoneNo']."</td></tr> 
	 <tr><td>店铺联系地址：</td><td>".$row['dealerAddr'] ."</td></tr>
	 <tr><td>店铺联系邮箱：</td><td>".$row['dealerEmail']."</td></tr>
	 <tr><td>店铺表述：</td><td>".$row['shopDescription']."</td></tr>
	 <tr><td>店铺等级：</td><td>".$row['dealerCredit']."</td></tr>
	 <tr><td>使用者评价：</td><td>".$row['userPraise']."</td></tr>
	 <tr><td>好友店铺：</td><td>".$row['dealerFriendo']."</td></tr>
	 </table>
	 </div></div>
	 ";
	 return $shopInfoHandle_disp;
}
function get_goods_form($shopId){
	 $goodsInfo_form="
	 <div id=\"shop_handle\">
	 <a href='/core/shop_welcome.php'><div class=\"Bbutton orange  font_big\">店铺信息</div></a>
	 <div class=\"Bbutton blue font_big\">商品仓库</div>
	 <a href='/core/shop_orderForm_show.php'><div class=\"Bbutton orange font_big\">店铺订单</div></a>
	 <a href='/core/shop_goods_upload.php'><div class=\"Bbutton orange font_big\">添加商品</div></a>
	 </div>
	 <div id=\"goodsForm\"><h3>上架的商品：</h3><div id=\"goodsInfo\">";

	$rows = get_goods($shopId);
		$goodsInfo_form=$goodsInfo_form.
		"
		<table>
			<thead>
				<tr>
					<th>商品编号</th>
					<th>图片</th>
					<th>类别</th>
					<th>备注</th>
					<th>所属商店编号</th>
					<th>商品描述</th>
					<th>价格</th>
					<th>评价</th>
					<th>操作</th>
				</tr>
			</thead>
		<tbody>";
		for($i = 0; $i < count($rows); $i++){
			$goodsInfo_form=$goodsInfo_form.
			"
				<tr>
					<td>".$rows[$i]['commId']."</td>
					<td><img src=\"/upload/".$rows[$i]['commId'].".jpg\"></></td>
					<td>";
		if($rows[$i]['cateId'] == 0){
			$goodsInfo_form=$goodsInfo_form."书籍"; 
		}
		else if($rows[$i]['cateId'] == 1){
			$goodsInfo_form=$goodsInfo_form."其他" ;
		}	
		$goodsInfo_form=$goodsInfo_form."</td><td>";

		if($rows[$i]['isbn'])
				$goodsInfo_form=$goodsInfo_form."<p>书名：".$rows[$i]['commTitle'] . "</p>" . 
					 "<p>作者：" . $rows[$i]['author'] . "</p>" . 
					 "<p>出版社：" . $rows[$i]['press'] .  "</p></td>"	; 
		$goodsInfo_form=$goodsInfo_form."<td>".$rows[$i]['shopId']."</td>
		<td>".$rows[$i]['commDescription']."</td>
		<td>￥".$rows[$i]['price']."</td>
		<td>".$rows[$i]['add_time']."</td>";
		$goodsInfo_form=$goodsInfo_form."<td><a href="."'shop_drop_goods.php?commId=".$rows[$i]['commId']."'><div class=\"button red\">删除</div></a></td></tr>";
	}
	if(count($rows)>0)
		$goodsInfo_form=$goodsInfo_form."</tbody></table></div>";
	return $goodsInfo_form;
}
function get_orderFrom_form($shopId){
	 $goodsInfo_form="
	 <div id=\"shop_handle\">
	 <a href='/core/shop_welcome.php'><div class=\"Bbutton orange  font_big\">店铺信息</div></a>
	 <a href='/core/shop_goods_show.php'><div class=\"Bbutton orange font_big\">商品仓库</div></a>
	 <div class=\"Bbutton blue font_big\">店铺订单</div>
	 <a href='/core/shop_goods_upload.php'><div class=\"Bbutton orange font_big\">添加商品</div></a>
	 </div>
	 <div id=\"goodsForm\"><h3>店铺订单：</h3><div id=\"goodsInfo\">";

	$rows = get_goods($shopId);
		$goodsInfo_form=$goodsInfo_form.
		"
		<table>
			<thead>
				<tr>
					<th>订单编号</th>
					<th>商品编号</th>
					<th>图片</th>
					<th>数量</th>
					<th>总价</th>
					<th>交易地址</th>
					<th>买家信息</th>
					<th>订单状态</th>
				</tr>
			</thead>
		<tbody>";
		for($i = 0; $i < count($rows); $i++){
			$goodsInfo_form=$goodsInfo_form.
			"
				<tr>
					<td>".$rows[$i]['orderId']."</td>
					<td>".$rows[$i]['commId']."</td>
					<td><img src=\"/upload/".$rows[$i]['commId'].".jpg\"></></td>
					<td>".$rows[$i]['number']."</td>
					<td>".$rows[$i]['price']."</td>
					<td>".$rows[$i]['address']."</td>
					<td><p><a href='".$row[$i]."'>".$rows[$i]['name']."</p><p>".$rows[$i]['phonenumber']."</a></p><p>".$rows[$i]['number']."</p></td>
					<td>".$rows[$i]['state']."</td>";
					
		}
	if(count($rows)>0)
		$goodsInfo_form=$goodsInfo_form."</tbody></table></div>";
	return $goodsInfo_form;
}
function get_upload_form(){

	 $uploadInfo_form="
	 <div id=\"shop_handle\">
	  <a href='/core/shop_welcome.php'><div class=\"Bbutton orange  font_big\">店铺信息</div></a>
	 <a href='/core/shop_goods_show.php'><div class=\"Bbutton orange font_big\">商品仓库</div></a>
	 <a href='/core/shop_orderForm_show.php'><div class=\"Bbutton orange font_big\">店铺订单</div></a>
	 <div class=\"Bbutton blue font_big\">添加商品</div>
	 </div>";
	$uploadInfo_form=$uploadInfo_form.
	"<div id=\"uploadForm\">
	<h3>请上传您的商品:</h3>
	<form id=\"upload\" name=\"upload\" method=\"post\" action=\"/core/shop_upload.php\" enctype=\"multipart/form-data\">
	<p><span>商品照片</span>:
	<input id=\"goodspic\"  name=\"goodspic\" type=\"file\" accept=\"image/jpeg,image/png,image/gif\"/>
	<div class=\"upload_goods_info hide\"><i></i><div id=\"goodspic_info\">请上传您的商品图片</div></div></p>
	<p><span>商品类别:</span>
	<select id=\"cate\" name=\"cate\"><option value=\"0\">书籍</option><option value=\"1\">其他</option></select>
	<div class=\"upload_goods_info hide\"><i></i><div id=\"cate_info\">请选择您的商品类别</div></div></p>
	<p><span>商品名称:</span>
	<input id=\"commTitle\" name=\"commTitle\" type=\"text\" />
	<div class=\"upload_goods_info hide\"><i></i><div id=\"commTitle_info\">请注明商品名称</div></div></p>
	<p><span>作者:</span>
	<input id=\"author\" name=\"author\" type=\"text\" />
	<div class=\"upload_goods_info hide\"><i></i><div id=\"author_info\">请注明书籍作者</div></div></p>
	<p><span>出版社:</span>
	<input id=\"press\" name=\"press\" type=\"text\" />
	<div class=\"upload_goods_info hide\"><i></i><div id=\"press_info\">请注明书籍出版社</div></div></p>
	<p><span>在此输入商品标价:</span>
	<input id=\"goods-price\" name=\"goods-price\" type=\"text\"/>￥
	<div class=\"upload_goods_info hide\"><i></i><div id=\"press_info\">请注明商品价格</div></div></p>
	<p><span>商品描述:</span><div class=\"upload_goods_info hide\"><i></i><div id=\"good-describe_info\">请给你的商品来点介绍吧</div></div></p>
	<textarea id=\"goods-describe\" name=\"goods-describe\" cols=\"50\" rows=\"5\"></textarea><br />	
	<input class=\"button blue\"type=\"submit\" name=\"submit\" value=\"提交\" />
	</form></div>";
	return $uploadInfo_form;

}
?>

