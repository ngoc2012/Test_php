<?php
/* Smarty version 3.1.48, created on 2025-11-04 15:01:17
  from '/home/minh/Test/templates/city_weather.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690a072d8e2293_05915951',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17a06f21b341aa4cc8f24c5c009595fab739b197' => 
    array (
      0 => '/home/minh/Test/templates/city_weather.tpl',
      1 => 1762264852,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690a072d8e2293_05915951 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm p-4 mb-4">
        <h1 class="text-center mb-4">🌤️ Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value, ENT_QUOTES, 'UTF-8', true);?>
</h1>
        <p class="fs-5"><strong>Temperature:</strong> <?php echo $_smarty_tpl->tpl_vars['weather']->value['temperature'];?>
 °C</p>
        <p class="fs-5"><strong>Humidity:</strong> <?php echo $_smarty_tpl->tpl_vars['weather']->value['humidity'];?>
%</p>
    </div>

    <?php if (!empty($_smarty_tpl->tpl_vars['history']->value)) {?>
    <div class="card shadow-sm p-4">
        <h2 class="mb-3">Last Weather Records</h2>
        <ul class="list-group list-group-flush">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['history']->value, 'record');
$_smarty_tpl->tpl_vars['record']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['record']->value) {
$_smarty_tpl->tpl_vars['record']->do_else = false;
?>
            <li class="list-group-item">
                <span class="text-muted"><?php echo $_smarty_tpl->tpl_vars['record']->value['date'];?>
 <?php echo $_smarty_tpl->tpl_vars['record']->value['time'];?>
</span>
                <span class="ms-3">🌡️ <?php echo $_smarty_tpl->tpl_vars['record']->value['temperature'];?>
 °C</span>
                <span class="ms-3">💧 <?php echo $_smarty_tpl->tpl_vars['record']->value['humidity'];?>
%</span>
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
    <?php }?>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-secondary">← Return to Home</a>
    </div>
</div>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
