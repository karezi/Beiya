<?php /* Smarty version Smarty-3.1.13, created on 2013-03-10 02:46:22
         compiled from "d:\xampp\htdocs\beiya\templates\usr_login.html" */ ?>
<?php /*%%SmartyHeaderCode:21931513be5ee8da1d8-46340232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '021ecaa6014bb245b8e8a86491da12982189785d' => 
    array (
      0 => 'd:\\xampp\\htdocs\\beiya\\templates\\usr_login.html',
      1 => 1361860390,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21931513be5ee8da1d8-46340232',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'header' => 0,
    'navigation' => 0,
    'login_disp' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_513be5eeabffc9_30289081',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513be5eeabffc9_30289081')) {function content_513be5eeabffc9_30289081($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head><title>Log in</title>
	
	<link rel="stylesheet" href="../css/main.css" type="text/css" />
<link rel="stylesheet" href="../css/content.css" type="text/css" />
<link rel="stylesheet" href="../css/goodInfo.css" type="text/css" />
<link rel="stylesheet" href="../css/button.css" type="text/css" />
<link rel="stylesheet" href="../css/login.css" type="text/css" />
<script type="text/javascript" src="../js/jquery.js" ></script>
<script type="text/javascript" src="../js/search.js" ></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<div id="header">
	   <?php echo $_smarty_tpl->tpl_vars['header']->value;?>

    </div>
    	<div id="navigation">
    		<?php echo $_smarty_tpl->tpl_vars['navigation']->value;?>

    	</div>
<div id="main">
  <div id="content">
    <div id="login"> <!--This is the main block of the page-->
    	<?php echo $_smarty_tpl->tpl_vars['login_disp']->value;?>

    </div>
  </div>
</div>
    <div id="footer">
    	<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

    </div>
</body>
</html><?php }} ?>