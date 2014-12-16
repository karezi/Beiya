<?php
 function filled_out($form_vars)
 {
 // test that each variable has a value
  foreach ($form_vars as $key=>$value)
  {
    if((!isset($key))||($value=='')) 
     {
      return false;
     }
  }
  return true;
 }
 
 function ok_username($username){
    try{
      $conn=db_connect();
      $query="select* from userinfo where userName='".$username."'";
      $result=$conn->query($query);
      if($result->num_rows>0)
      {
        return false;
      }
      else {
        return true;
      }
    }
    catch(Exception $e)
    {
      echo $e->getMessage();
      exit();
    }

 }

 function valid_email($address)
 {
  if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/',$address))
  {return true;}
  else {return false;}
 }
?>