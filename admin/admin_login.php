<?php
   require("admin_flib.php");
   show_site_header("");
?>
  <form action="admin.php" method="post">
  	<label for="adminname">Adminname:</label>
          <input type="text" id="adminname" name="adminname" /><br/>
          
      <label for="password">Password:</label>
          <input type="password" id="password" name="password" /><br/>   
      <input type="submit" value="Submit!" />    	       
  </form>
 <?php  
  show_url("forgot_password.php"," reset the forgotten password");
  show_site_footer();
?>