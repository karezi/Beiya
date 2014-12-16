<?php
//part1 displaying funcs here
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

 function show_url($url,$url_show)
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
 

 function display_admin_menu()
 {
  show_url("insert_commodity_form.php","Insert commodity");
  show_url("insert_category_form.php","Insert category");
  show_url("user_manage.php","User Manage");
 }
 
 function display_cateinsert_form(){
 ?>
  <form action="insert_category_form.php" method="post">
  	<label for="cateId">cateId:</label>
          <input type="text" id="cateId" name="cateId" /><br/>
          
      <label for="cateName">cateName:</label>
          <input type="text" id="cateName" name="cateName" /><br/>   
      <input type="submit" value="Submit!" />    	       
  </form>
 <?php
 }

 function display_comminsert_form(){
 ?>
  <form action="insert_commodity_form.php" method="post">
  	<label for="cateId">cateId:</label>
          <input type="text" id="cateId" name="cateId" /><br/>
          
      <label for="shopId">shopId:</label>
          <input type="text" id="shopId" name="shopId" /><br/>

    <label for="commTitle">Name of commodity:</label>
          <input type="text" id="commTitle" name="commTitle" /><br/>

    <label for="price">Price of commodity:</label>
          <input type="text" id="price" name="price" /><br/>

      <input type="submit" value="Submit!" />    	       
  </form>
 <?php
 }



//part2 data processing funcs here
 function db_connect()
 {
 	$result=new mysqli('localhost','freenik','haxerocks','beiya');
    if(!$result)
    {
    	throw new Exception("Could not connect to database server."); 	
    }
    else{
    	return $result;
    }
 }

 function login($adminname,$password){
     $conn=db_connect();
     $encrypted_pass=sha1($password);
     //check if we have this adminname
     $result=$conn->query("select * from admin where 
     	adminName='".$adminname."' and passWord='".$encrypted_pass."'");
     if(!$result)
     	{
     		throw new Exception('Could not log you in.');
     	}
     if($result->num_rows>0)
     {
     	return true;
     }
     else {
     	throw new Exception('Could not log you in.');
     }
 }
?>