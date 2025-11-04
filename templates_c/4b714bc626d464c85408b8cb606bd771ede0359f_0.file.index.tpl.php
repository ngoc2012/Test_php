<?php
/* Smarty version 3.1.48, created on 2025-11-04 14:33:13
  from '/home/minh/Test/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690a00992eb038_02465121',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b714bc626d464c85408b8cb606bd771ede0359f' => 
    array (
      0 => '/home/minh/Test/templates/index.tpl',
      1 => 1762263190,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690a00992eb038_02465121 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>City List</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
    <h1>All Cities</h1>
    <ul>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cities']->value, 'city');
$_smarty_tpl->tpl_vars['city']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['city']->value) {
$_smarty_tpl->tpl_vars['city']->do_else = false;
?>
        <li>
            <form method="post" action="city_weather.php" style="display:inline">
                <input type="hidden" name="cityName" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value['cityName'], ENT_QUOTES, 'UTF-8', true);?>
">
                <button type="submit"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value['cityName'], ENT_QUOTES, 'UTF-8', true);?>
</button>
            </form>
        </li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
</body>
</html>
<?php }
}
