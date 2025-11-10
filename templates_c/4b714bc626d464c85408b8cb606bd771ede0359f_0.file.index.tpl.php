<?php
/* Smarty version 3.1.48, created on 2025-11-10 12:04:15
  from '/home/minh/Test/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6911c6af58a739_04325880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b714bc626d464c85408b8cb606bd771ede0359f' => 
    array (
      0 => '/home/minh/Test/templates/index.tpl',
      1 => 1762772608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6911c6af58a739_04325880 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #343a40; color: #f8f9fa;">

<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <?php echo $_smarty_tpl->tpl_vars['container']->value;?>

</div>

<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
