<?php
/* Smarty version 3.1.48, created on 2025-11-04 14:55:27
  from '/home/minh/Test/templates/city_weather.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690a05cfef5f51_64096107',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17a06f21b341aa4cc8f24c5c009595fab739b197' => 
    array (
      0 => '/home/minh/Test/templates/city_weather.tpl',
      1 => 1762264523,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690a05cfef5f51_64096107 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <h1>Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value, ENT_QUOTES, 'UTF-8', true);?>
</h1>

    <p>Temperature: <?php echo $_smarty_tpl->tpl_vars['weather']->value['temperature'];?>
 °C</p>
    <p>Humidity: <?php echo $_smarty_tpl->tpl_vars['weather']->value['humidity'];?>
%</p>

    <?php if (!empty($_smarty_tpl->tpl_vars['history']->value)) {?>
    <h2>Last Weather Records for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value, ENT_QUOTES, 'UTF-8', true);?>
</h2>
        <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['history']->value, 'record');
$_smarty_tpl->tpl_vars['record']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['record']->value) {
$_smarty_tpl->tpl_vars['record']->do_else = false;
?>
            <li>
                <?php echo $_smarty_tpl->tpl_vars['record']->value['date'];?>
 <?php echo $_smarty_tpl->tpl_vars['record']->value['time'];?>
 - <?php echo $_smarty_tpl->tpl_vars['record']->value['temperature'];?>
 °C - <?php echo $_smarty_tpl->tpl_vars['record']->value['humidity'];?>
%
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    <?php }?>
    <a href="index.php">Return to home</a>
</body>
</html>
<?php }
}
