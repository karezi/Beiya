<?php
 require_once("../fclib/beiya_fclib.php");
 require_once("../main.php"); 
 session_start();

 
 $regi_main='';  //main block of html

 if(isset($_POST['email'])&&isset($_POST['username'])
 	&&isset($_POST['password'])&&isset($_POST['password2']))
 {  //received the post form
   //create short variable names
   $email=$_POST['email'];
   $username=$_POST['username'];
   $password=$_POST['password'];
   $password2=$_POST['password2'];	

   try {
   	
   	//check if the form is filled out
   	if(!filled_out($_POST))
   	{
   		throw new Exception('You have not filed the form out correctly - please go back and try again');
       }
    //check if the name has been taken
    if(!ok_username($username))
    {
        throw new Exception('The name has been taken - please choose another name.');
    }
      // email address not valid
    if(!valid_email($email))
       { throw new Exception('That is not a valid email address.');
       } 
       
      //passwords not the same
    if($password!=$password2)
       { throw new Exception('The passwords you entered do not match - please go back and try again.');
       } 
     
      //check password length is ok
      //ok if username truncates, but passwords will get
      //munged if they are too long.
    if((strlen($password)<6)||(strlen($password)>16))
       { throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
       }
   
    //down here, the checkings are done! then we start to register the new user's info
    //now we try to register him by this register() function in user_func.php
    register($username,$email,$password);
    
    //register successfully
    $_SESSION['valid_user']=$username;
    
    //Now we are gonna provide real services
    $regi_main=$regi_main."Congratulations! Registration successful!<br/>
                           Your registration was successful.
                           Go to the members pages to start getting your stuff!<br/><br/>
                           <div><a href=\"/index.php\">Go to main page</a></div>";

   } catch (Exception $e) {
   	  echo "Problem:<br/>".$e->getMessage()."<div><a href=\"/index.php\">Go to main page</a></div>";
   	  exit();
   }
 }
 else {  //Display the form
  $regi_main="<p>请输入注册信息：</p>".get_Html_regiForm();
 }

 $header=getHeader();
 $footer=getFooter(); 
 
 $smarty->assign("header",$header);
  $smarty->assign("navigation",getNavigation());
 $smarty->assign("footer",$footer);
 $smarty->assign("regi_main",$regi_main);
 
 $smarty->display("usr_register_new.html");
?>