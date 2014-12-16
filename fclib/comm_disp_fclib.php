<?php
/*
  This page is Simmering with perplexing functions!
  I ain't gonna give ya any spur..
  If you really wanna go for it.. Schlaefst du eigentlich noch?
*/
//part1 for index.php
function get_biggenres(){
  $conn=new_db_connect();
  $query="select bgenId,bgenName from biggenres";
  $result=$conn->query($query);
  if(!$result)
    { 
      return false;
    }
  $num_bgens=@$result->num_rows;
  if($num_bgens==0)
  {
    return false;
  }
  $result=db_result_to_array($result); //we are gonna have an associated array     
  return $result;
}

function getHtmlStr_biggenres($biggenres){ //turn this $biggenres array to a string wit html tags 
  $str_biggenres='';
  if(!is_array($biggenres))
  {
    $str_biggenres="<p><b>No big genres now available.</b></p>";
    return $str_biggenres;
  }
  $str_biggenres="<ul>";
  foreach($biggenres as $row)
  {
    $url="./show/show_biggenre.php?bgenid=".$row['bgenId']."";
    $title=$row['bgenName'];
    $str_biggenres=$str_biggenres."<li><a href=\"".$url."\" class=\"show_biggens\">".$title."</a></li><br/>";
  }
  $str_biggenres=$str_biggenres."</ul><hr/>";
  return $str_biggenres;
}

//part2 for show_biggenre.php
function get_biggenre_name($bgenid){
  try{
  $conn=db_connect();
  $query="select bgenName from biggenres where bgenId='".$bgenid."'";
  $result=$conn->query($query);
  if(!$result)
  {
    return false;
  }
    } catch(Exception $e)
    {
      echo $e->getMessage();
      exit();
    }
    $num_biggens=@ $result->num_rows;
    if($num_biggens==0)
    {
      return false;
    }
    $row=$result->fetch_object();
    return $row->bgenName;
}

function get_smallgens($bgenid){
  $conn=new mysqli('localhost','root','zxzczvxia','beiya');
  if(mysqli_connect_errno())
  {
    echo 'Connection to database failed:'.mysqli_connect_error();
    exit();
  }
  $query="select sgenId,sgenName from smallgenres where bgenId='".$bgenid."'";
  $result=$conn->query($query);
  if(!$result)
  { 
    return false;
  }
  $num_sgens=@$result->num_rows;
  if($num_sgens==0)
  {
    return false;
  }
  $result=db_result_to_array($result);    
  return $result;
}

function getHtmlStr_smallgens($smallgens)
{
  $str_smallgens='';     
  if(!is_array($smallgens))
  {
    $str_smallgens="<p><b>No small genres now available.</b></p>";
    return $str_smallgens; 
  }
  $str_smallgens="<ul>";
  foreach($smallgens as $row)
  {
    $url="show_smallgenre.php?sgenid=".$row['sgenId']."";
    $title=$row['sgenName'];
    $str_smallgens=$str_smallgens."<li><a href=\"".$url."\" class=\"show_smallgens\">".$title."</a></li><br/>";
  }
  $str_smallgens=$str_smallgens."</ul><hr/>";
  return $str_smallgens;
}

//part3 for show_smallgenre.php
function get_smallgenre_name($sgenid)
{
  try{
  $conn=db_connect();
  $query="select sgenName from smallgenres where sgenId='".$sgenid."'";
  $result=$conn->query($query);
  if(!$result)
  {
    return false;
  }
    } catch(Exception $e)
    {
      echo $e->getMessage();
      exit();
    }
    $num_smallgens=@ $result->num_rows;
    if($num_smallgens==0)
    {
      return false;
    }
    $row=$result->fetch_object();
    return $row->sgenName;
}

function get_categories($sgenid){
	$conn=new mysqli('localhost','freenik','haxerocks','beiya');
             if(mysqli_connect_errno())
             {
              echo 'Connection to database failed:'.mysqli_connect_error();
              exit();
             }
       $query="select cateId,cateName from categories where sgenId='".$sgenid."'";
       $result=$conn->query($query);
       if(!$result)
             { 
             	return false;
             }
           $num_cates=@$result->num_rows;
           if($num_cates==0)
             {
             	return false;
             }
           $result=db_result_to_array($result);    
           return $result;
}

function getHtmlStr_categories($cate_array){ //turn this categories array to a string wit html tags 
	$str_categories='';     
	if(!is_array($cate_array))
	{
		$str_categories="<p><b>No categories now available.</b></p>";
		return $str_categories; 
	}
	$str_categories="<ul>";
	foreach($cate_array as $row)
	{
		$url="./show_category.php?cateid=".$row['cateId']."";
		$title=$row['cateName'];
		$str_categories=$str_categories."<li><a href=\"".$url."\" class=\"cates_links\">".$title."</a></li><br/>";
	}
	$str_categories=$str_categories."</ul><hr/>";
	return $str_categories;
}
function get_comm_name($cateid)
{
	try{

	$conn=db_connect();
	$query="select commTitle from comminfo where commId='".$cateid."'";
	$result=$conn->query($query);
	if(!$result)
    $conn->close();
    return false;
  } catch(Exception $e)
    {
      $conn->close();
    	echo $e->getMessage();
    	exit();
    }
    $num_catename=@ $result->num_rows;
    if($num_catename==0)
    {
      $conn->close();
    	return false;
    }
    $row=$result->fetch_object();
    $conn->close();
    return $row->commTitle;
}
//part4 for show_category.php
function get_category_name($cateid)
{
	try{

	$conn=db_connect();
	$query="select cateName from categories where cateId='".$cateid."'";
	$result=$conn->query($query);
	if(!$result)
    $conn->close();
    return false;
  } catch(Exception $e)
    {
      $conn->close();
    	echo $e->getMessage();
    	exit();
    }
    $num_catename=@ $result->num_rows;
    if($num_catename==0)
    {
      $conn->close();
    	return false;
    }
    $row=$result->fetch_object();
    $conn->close();
    return $row->cateName;
}


function get_comms($cateid,$page=1,$pagesize=10)  //the default pagesize is 10
{
 
  try{
   $conn=db_connect();
  } catch(Exception $e)
  {
    $conn->close();
  	echo $e->getMessage();
    exit();
  }

  $query="select commId,cateId,shopId,commTitle,commPhotoId,
      isbn,author,press,price,discount from comminfo where cateId='".$cateid."' limit ".$pagesize." offset ".($page-1)*$pagesize;
  
  $result=$conn->query($query); 
  if(!$result)
    { 
      $conn->close();
      return false;
    }
  $num_cates=@$result->num_rows;
  if($num_cates==0)
     {
      $conn->close();
       return false;
    }
  
  $result=db_result_to_array($result); 
  $conn->close();

  
  return $result;
    
}

function count_maxPageNum($cateid,$pagesize=9)
{
  $conn=new_db_connect();   
  // Due to the calling order in 'show_category.php', a new connection need not be created
  $query="select commId from comminfo where cateId=".$cateid;  //which way is faster? select commId : select * 

  $result=$conn->query($query) or die("Sorry..We have a problem. Please visit again.");
  $numRows=$result->num_rows;   //no problem here
  $conn->close();
  $maxPageNum=(int)ceil($numRows/$pagesize);
  return $maxPageNum;
}

function getHtmlStr_comms($comms,$page=1,$maxPageNum) // turn this comms array into a string with html tags
{
  $str_comms='';     
  if(!is_array($comms))
  {
    $str_comms="<p><b>No commodities now available.</b></p>";
    return $str_comms; 
  }
  $str_comms="";


  /* 
    Turn the comm info into html strings.
    But before that, we need to get the shop name from its shopid.
  */
    $shopnames=array();
    $query_SN="select shopName from shopinfo where";
    $i=1; # counter
    $comms_len=count($comms);
    foreach ($comms as $row) {
      if($i!=$comms_len){
        $query_SN=$query_SN." shopId=".$row['shopId']." or";
      }   
      else {
        $query_SN=$query_SN." shopId=".$row['shopId'];
      }
      $i++;
    }
    // Need to establish a new connection, that's a waste...
    try{
       $conn=new_db_connect();
    } catch(Exception $e)
     {
     echo $e->getMessage();
     exit();
    }
    $result1=$conn->query($query_SN);
    
    $res_array=array();
    for ($count=0; $row=$result1->fetch_assoc();$count++)
    { 
      $res_array[$count]=$row;
    }
    $conn->close(); // close the connection
    for($i=0;$i<$comms_len;$i++){
      $shopnames[$i]=$res_array[$i]['shopName'];
    }

  $i=0;  #counter
  // Here string comes:
  foreach($comms as $row)
  {
    $comm_url="show_commodity.php?commid=".$row['commId'];
    $cateid=$row['cateId'];
    $title=$row['commTitle'];
    $shopid=$row['shopId'];
    $shop_url="/core/shop_welcome.php?shopid=".$shopid;
    $shopname=$shopnames[$i];  // get the shop's name
    $i++;

    $photoid=check_photo($row['commPhotoId']); //check if we have a commodity photo;If not, we use a default one
    $price=$row['price'];
    $discount=$row['discount'];

 
    //if "isbn" is default(0),then this commodity not a book!
    $isbn=$row['isbn'];
    //Check if it's a book
    if($isbn){   
     //It's a book
      $author=$row['author'];
      $press=$row['press'];
      $str_comms=$str_comms."
         <div class=\"goodsBox\">
          <div class=\"gradePic\"> <a href=\"".$comm_url."\"><img src=\"../img/commodity/".$photoid.".jpg\"></a></div>
          <div class=\"InfoBar\">
            <div class=\"goodsName\">".$title."</div>
            <div class=\"price\"><b>￥</b>".$price."</div>
          </div>
        </div>
         ";
    }else{
    //Not a book
      $str_comms=$str_comms."
      <div class=\"goodsBox\">
        <div class=\"gradePic\"> <a href=\"".$comm_url."\"><img src=\"../img/commodity/".$photoid.".jpg\"></a></div>
          <div class=\"InfoBar\">
            <div class=\"goodsName\">".$title."</div>
            <div class=\"price\"><b>￥</b>".$price."</div>
          </div>
        </div>";
    }
  }

//  $str_comms=$str_comms."<div class=\"page_contr\">
//                           <a href=\"show.category.php?page=".($page-1)."\" class=\"word_page\">Last Page</a>&nbsp;&nbsp;&nbsp;&nbsp;";
	if($page>1)
	{
	$str_comms=$str_comms."<div class=\"pagination\"> 
		<a href=\"href=\"show.category.php?page=".($page-1)."\" class=\"num_page\"><span class=\"last\">".($page-1)."</span></a>";
   }
   else
   {
	$str_comms=$str_comms."<div class=\"pagination\">";
   }
  for($i=1;$i<=$maxPageNum;$i++)
  {
  	if($i!=$page)
    	$str_comms=$str_comms."<a href=\"show.category.php?page=".$i."\"><span class=\"page\">".$i."</span></a>";
    else
    	$str_comms=$str_comms."<span class=\"page current\">".$i."</span>";
  }
	if($page!=$maxPageNum)
  	$str_comms=$str_comms."<a href=\"show.category.php?page=".($page+1)."\"><span class=\"next\">下一页</span></a>
                      </div>";
  else
  	$str_comms=$str_comms."</div>";
  
   // page control  ### end of the div - class="comms"
  return $str_comms;
}

//part5 for show_comm.php  


function get_comm_details($commid,$bk_flag=0){ //we use $bk_flag to know if it's a book,1 for yes,0 for no
  $conn=new_db_connect();
  if($bk_flag!=0){ //it's a book
    $query="select commId,cateId,shopId,commTitle,commDescription,
        commPhotoId,isbn,author,press,price,ratings,discount from
        comminfo where commId='".$commid."'";    
  }else{
    $query="select commId,cateId,shopId,commTitle,commDescription,
        commPhotoId,price,ratings,discount from
        comminfo where commId='".$commid."'";
  }
    $query="select * from
        comminfo where commId='".$commid."'"; 
  $result=$conn->query($query);
  if(!$result)
    { 
      return false;
    }
  $num_dets=@$result->num_rows;
  if($num_dets==0)
  { 
    $conn->close();
    return false;
  }
  $result=db_result_to_array($result);

  return $result;
}


function getHtmlStr_comm_details($details,$bk_flag=1){ //$details is an associated array
  $str_details='';
  if(!is_array($details))
  {
    return "<p><b>Sorry. It seems some info lost its way..</b></p>";
  }
  $details=$details[0];


  $str_details="<div class=\"commdetail_block1\">";
    //the details down here:
    $title=$details['commTitle'];
    $cateid=$details['cateId'];
    $shopid=$details['shopId'];
    $shop_url="/core/shop_view.php?shopid=".$shopid;
    $shopname=check_shopname($shopid);  //check and get the shop's name
    $description=$details['commDescription'];
    $photoid=check_photo($details['commPhotoId']); //check if we have a commodity photo;If not, we use a default one
    $price=$details['price'];
    $discount=$details['discount'];
    $comment="";
    $comment=$comment."";
//    
//   	try{
//		$conn=db_connect();
//		$query="select * from shopinfo where shopId='".$shopid."'";
//		$result=$conn->query($query);
//		if(!$result)
//    $conn->close();
//    return false;
//  	} catch(Exception $e)
//    {
//      $conn->close();
//    	echo $e->getMessage();
//    	exit();
//    }
//    $num_catename=@ $result->num_rows;
//    if($num_catename==0)
//    {
//      $conn->close();
//    	return false;
//    }
//    $row=$result->fetch_object();
//    $conn->close();
    
    
  if($bk_flag){ //if it's a book
    $isbn=$details['isbn'];
    $author=$details['author'];
    $press=$details['press'];
    
    
//      <div class=\"comm_shopInfo\">
//      	<div class=\"comm_shopInfo_name\">".$row['shopName']."</div>
//      	<div class=\"comm_shopInfo_item\"><span>商店编号：</span>".$row['shopId']."</div>
//      	<div class=\"comm_shopInfo_item\"><span>店主：</span>"."</div>
//      	<div class=\"comm_shopInfo_item\"><span>邮箱：</span>".$row['dealerEmail']."</div>
//      </div>
    
    $comment=$comment."
      <div class=\"goodsInfo\">
      <div class=\"goodsImage\" id=\"\"><img src=\"../img/commodity/".$photoid.".jpg\"></div>
      <div class=\"goodsDetail\" id=\"\">
        <h3 class=\"goods_name\">".$title."</h3>
        <div class=\"goodItem goods_id\"><span class=\"goodItem\"><label>商品编号：</label></span>".$details['commId']."</div>";
       if($discount!=1)$comment=$comment."
        <div class=\"goodItem price\"><span class=\"goodItem\"><b>现价：</b></span><span class=\"price1 blue\">￥<strong>".$details['price']*$details['discount']."</strong></span><span class=\"discount\">(".$row['discount']."折)</span></div>";
       else
       $comment=$comment."
        <div class=\"goodItem price2\"><span class=\"goodItem\">价格：</span>￥".$details['price']."</div>";
        $comment=$comment."
        <div class=\"goodItem\"><span class=\"goodItem\">库存:</span><span class=\"font_red\"><b>12</b></span>件</div>
        <div class=\"buiedNum\"><span class=\"goodItem\">已售出:</span><span class=\"font_red\">12</span>件</div>
        <div class=\"evaluate_box\"><span class=\"goodItem\">评分：</span><span class=\" hide-textindent dp\">一星</span><cite>0分</cite></div>
        <form id=\"item_form\" class=\"item_form\">
          <div class=\"item_number\">
            <input class=\"min\" type=\"button\" value=\"-\" name=\"\" id=\"buy_min\">
            <input class=\"quantity\" type=\"text\" value=\"1\" name=\"\" id=\"buy_num\">
            <input class=\"add\" type=\"button\" value=\"+\" name=\"\" id=\"buy_add\">
          </div>
            <a  href=\"#is_check_prop\"><div id=\"add_cart\"><img src=\"../img/cart_add.png\"></div></a>
          <a href=\"\"><div id=\"buy_now\"><img src=\"../img/buy_now.png\"></div></a>
        </form>
      </div>
      <div class=\"goods_text\"> </div>
    </div>";
  }else{//not a book

  }  
 
  return $comment;
}

//part6 for index.php getting info
function index_recom(){  //get the recommended goods for index
  $conn=new_db_connect();
  $query="(select id,l_r from rating where `idtype`=\"c\" group by `id` ORDER BY `total`/`votes` desc limit 100) 
  ORDER BY `l_r` desc limit 5";
  $result=$conn->query($query);
  if(!$result)
    { 
      return false;
    }
  $id_arr=db_result_to_array($result);

  $query="select * from comminfo where ";
  for($i=0;$i<count($id_arr);$i++){
    if($i!=count($id_arr)-1){
      $query=$query."commId=".$id_arr[$i]['id']." or ";
    } else {
      $query=$query."commId=".$id_arr[$i]['id'];
    }
  }
  $result=$conn->query($query);
  $comm_arr=db_result_to_array($result);

  $conn->close();
  return $comm_arr;
}

function index_fri_recom(array $fri_arr){  // this parameter is an array of names of friends
  $conn=new_db_connect();
  $fri_recom_arr=array(); //we r gonna need this array soon enough
  foreach($fri_arr as $fr_name){
    $query="select id from raty where uname=\"".$fr_name."\" and idtype=\"c\" order by value limit 3";
    $result=$conn->query($query);
    if($result){
      $result=$result->fetch_array();
      for($i=0;$i<count($result);$i++){
        $id=$result->id;
        $query="select * from comminfo where commId=$id";
        $result=$conn->query($query);
        $one_recom=$result->fetch_assoc(); // this is an array of one item from one certain friend
        $one_recom["fr_name"]=$fr_name;  //we add the info of the friend
        array_push($fri_recom_arr,$one_recom);
      }      // now we have an array of commodities with their features
        // we get more than we may need to set back-up
    }
  } 
  if($count=count($fri_recom_arr)>=5){ //if we've got enough recommendations
    $conn->close();
    $fri_recom_arr2=array(); //this array is what we need
    $arr45=array_rand($fri_recom_arr,5);  //choose 5 items randomly
    for($i=0;$i<5;$i++){
       array_push($fri_recom_arr2,$fri_recom_arr[$arr45[$i]]);
    }
    return $fri_recom_arr2;  //Done!
  } else { 
     //What if we cannot provide 5 recoms? Here it goes!
    /*
     return rand_fri_recom($fri_arr,$count);

     I don't wanna write this f**king function right now...It's not cool anyway
    */
     return false;
    /* 
      $count is the number of recoms we've got for now;
      this function is in user_func.php
      now we have it! */
  }

  
}
?>