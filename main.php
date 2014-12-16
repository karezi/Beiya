 <?php
define('SITE_ROOT','d:/xampp/htdocs/beiya/');
include_once (SITE_ROOT."libs/Smarty.class.php");	  //导入smarty核心类


$smarty = new Smarty(); 						//建立smarty实例对象$smarty
$smarty->template_dir=SITE_ROOT."/templates/";  //设置模板目录
$smarty->compile_dir=SITE_ROOT."/templates_c/"; //设置编译目录
$smarty->cache_dir=SITE_ROOT."/cache/";			//设置缓存目录
$smarty->caching=0; 							//缓存方式
$smarty->cache_lifetime=60*60*24*7;				//缓存期7天

$smarty->left_delimiter = "{{";					//设置smarty定界符
$smarty->right_delimiter = "}}";
?> 