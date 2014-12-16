<?php /* Smarty version Smarty-3.1.13, created on 2013-03-09 03:55:54
         compiled from "d:\xampp\htdocs\beiya\templates\index.html" */ ?>
<?php /*%%SmartyHeaderCode:27266513aa4ba58b337-74259670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47a76964859e1a9748f6492b379dc49d3dd3066e' => 
    array (
      0 => 'd:\\xampp\\htdocs\\beiya\\templates\\index.html',
      1 => 1362645578,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27266513aa4ba58b337-74259670',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'header' => 0,
    'navigation' => 0,
    'friend_recom' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_513aa4ba6aefb7_11033608',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513aa4ba6aefb7_11033608')) {function content_513aa4ba6aefb7_11033608($_smarty_tpl) {?><!DOCTYPE HTML>
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" href="css/content.css" type="text/css" />
<link rel="stylesheet" href="css/goodInfo.css" type="text/css" />
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/search.js" ></script>
<script type="text/javascript" src="js/navigation.js" ></script>
<script type="text/javascript" src="ajax/index.js" ></script>
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
  
  
    <div class="content1">

    </div>
    
    <?php echo $_smarty_tpl->tpl_vars['friend_recom']->value;?>

    
    <div class="content3">
  
     </div>
  </div>
</div>
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

</body>
</html><?php }} ?>