<?php
/* Smarty version 3.1.48, created on 2025-11-03 16:25:16
  from '/home/minh/Test/templates/hello.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6908c95c786d81_91317859',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac44736adf3fff57d1ed39821a6b075bec2882c4' => 
    array (
      0 => '/home/minh/Test/templates/hello.tpl',
      1 => 1762183499,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6908c95c786d81_91317859 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
  <head><title>Hello Smarty</title></head>
  <body>
    <h1>Hello, <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
!</h1>
    <p>This is a standalone <?php echo $_smarty_tpl->tpl_vars['project']->value;?>
.</p>
  </body>
</html>
<?php }
}
