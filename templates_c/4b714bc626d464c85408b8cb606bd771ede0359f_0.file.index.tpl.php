<?php
/* Smarty version 3.1.48, created on 2025-11-04 15:02:18
  from '/home/minh/Test/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690a076ab1ff39_53914191',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b714bc626d464c85408b8cb606bd771ede0359f' => 
    array (
      0 => '/home/minh/Test/templates/index.tpl',
      1 => 1762264936,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690a076ab1ff39_53914191 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-4">🌍 All Cities</h1>
    <div class="card shadow-sm p-4">
        <ul class="list-group list-group-flush">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cities']->value, 'city');
$_smarty_tpl->tpl_vars['city']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['city']->value) {
$_smarty_tpl->tpl_vars['city']->do_else = false;
?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value['cityName'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                <form method="post" action="city_weather.php" class="m-0">
                    <input type="hidden" name="cityName" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value['cityName'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <button type="submit" class="btn btn-primary btn-sm">View Weather</button>
                </form>
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
</div>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
