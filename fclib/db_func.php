<?php
  function db_connect()
    {
      $result=new mysqli('localhost','freenik','haxerocks','beiya');
      if(!$result)
       {  throw new Exception("Could not connect to database server.");
       }
      else {
        return $result;
	    } 
    }

  //new database connect function
  function new_db_connect()
  {
    $conn=new mysqli('localhost','freenik','haxerocks','beiya');
    if(mysqli_connect_errno())
    {
      echo 'Connection to database failed:'.mysqli_connect_error();
      exit();
    }else{
      return $conn;
    }
  }
  
  function db_result_to_array($result)
    {
     $res_array=array();
     
     for ($count=0; $row=$result->fetch_assoc();$count++)
       { 
        $res_array[$count]=$row;
       }
       
     return $res_array;  //then we are gonna have an array of associated arrays   
    }  
?>