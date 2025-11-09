<?php
/* Smarty version 3.1.48, created on 2025-11-09 22:16:05
  from '/home/minh-ngu/Test_php/templates/city_weather.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69110495859731_04152222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2ebed6b2b4a814e647c4a93743fa7ea93bee786' => 
    array (
      0 => '/home/minh-ngu/Test_php/templates/city_weather.tpl',
      1 => 1762722959,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69110495859731_04152222 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value->getName(), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container py-5">
    <div class="card bg-transparent text-light shadow-sm p-4 mb-4 border-2">
        <h1 class="text-center mb-4">🌤️ Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value->getName(), ENT_QUOTES, 'UTF-8', true);?>
</h1>
        <p class="fs-5"><strong>API:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['history']->value[0]->getApi(), ENT_QUOTES, 'UTF-8', true);?>
</p>
        <p class="fs-5"><strong>Temperature:</strong> <?php echo $_smarty_tpl->tpl_vars['history']->value[0]->getTemperature();?>
 °C</p>
        <p class="fs-5"><strong>Humidity:</strong> <?php echo $_smarty_tpl->tpl_vars['history']->value[0]->getHumidity();?>
%</p>
    </div>

    <div class="card bg-transparent text-light shadow-sm p-4 border-2">
        <h2 class="mb-4">Recent Weather Records</h2>
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="table-dark text-light">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">API</th>
                        <th scope="col">Temperature</th>
                        <th scope="col">Humidity</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['city']->value->getHistory(), 'record');
$_smarty_tpl->tpl_vars['record']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['record']->value) {
$_smarty_tpl->tpl_vars['record']->do_else = false;
?>
                    <tr>
                        <td class="text-info"><?php echo $_smarty_tpl->tpl_vars['record']->value->getCreatedAt();?>
</td>
                        <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['record']->value->getApi(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                        <td>🌡️ <?php echo $_smarty_tpl->tpl_vars['record']->value->getTemperature();?>
 °C</td>
                        <td>💧 <?php echo $_smarty_tpl->tpl_vars['record']->value->getHumidity();?>
%</td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-light">← Return to Home</a>
    </div>
</div>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
