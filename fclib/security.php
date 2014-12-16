<?php
function inject_check($sql_str) {  
  return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);      
} 


function str_check( $str ) {  
  if (!get_magic_quotes_gpc()) {    // 判断magic_quotes_gpc是否打开  
    $str = addslashes($str);    // 进行过滤  
  }  
  $str = str_replace("_", "\_", $str);    // 把 '_'过滤掉  
  $str = str_replace("%", "\%", $str);    // 把 '%'过滤掉  
 
  return $str;   
}  

function post_check($post) {  
  if (!get_magic_quotes_gpc()) {    // 判断magic_quotes_gpc是否为打开  
    $post = addslashes($post);    // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤  
  }  
  $post = str_replace("_", "\_", $post);    // 把 '_'过滤掉  
  $post = str_replace("%", "\%", $post);    // 把 '%'过滤掉  
  $post = nl2br($post);    // 回车转换  
  $post = htmlspecialchars($post);    // html标记转换  
 
  return $post;  
}   
?>