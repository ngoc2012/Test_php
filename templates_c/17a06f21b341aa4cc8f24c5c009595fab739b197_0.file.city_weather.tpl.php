<?php
/* Smarty version 3.1.48, created on 2025-11-10 16:09:32
  from '/home/minh/Test/templates/city_weather.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6912002ca03167_47560068',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17a06f21b341aa4cc8f24c5c009595fab739b197' => 
    array (
      0 => '/home/minh/Test/templates/city_weather.tpl',
      1 => 1762787367,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6912002ca03167_47560068 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['weather_panel']->value;?>


<div class="panel panel-default" style="background-color: transparent; border: 2px solid #ccc;">
    <div class="panel-heading" style="background-color: transparent; color: #343a40;">
        <h2>Recent Weather Records</h2>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>API</th>
                        <th>Temperature</th>
                        <th>Humidity</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['histories']->value, 'record');
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
</div>

<div class="text-center" style="margin-top: 20px;">
    <a href="index.php" class="btn btn-default">← Return to Home</a>
</div>
<?php }
}
