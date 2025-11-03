<?php
/* Smarty version 3.1.48, created on 2025-11-03 17:53:06
  from '/home/minh/Test/templates/city_weather.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6908ddf204db92_52929361',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17a06f21b341aa4cc8f24c5c009595fab739b197' => 
    array (
      0 => '/home/minh/Test/templates/city_weather.tpl',
      1 => 1762188776,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6908ddf204db92_52929361 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head><title>Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city_name']->value, ENT_QUOTES, 'UTF-8', true);?>
</title></head>
<body>
    <h1>Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city_name']->value, ENT_QUOTES, 'UTF-8', true);?>
</h1>

    <?php if ((isset($_smarty_tpl->tpl_vars['weather']->value['main']))) {?>
        <p>Temperature: <?php echo $_smarty_tpl->tpl_vars['weather']->value['main']['temp'];?>
 °C</p>
        <h2>Last Temperature Records for <?php echo $_smarty_tpl->tpl_vars['city_name']->value;?>
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
 °C
                </li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
    <?php } else { ?>
        <p>No weather data available.</p>
    <?php }?>

    <a href="index.php">Back to city list</a>
</body>
</html>
<?php }
}
