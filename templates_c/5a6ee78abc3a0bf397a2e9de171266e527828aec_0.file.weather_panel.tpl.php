<?php
/* Smarty version 3.1.48, created on 2025-11-10 12:49:37
  from '/home/minh/Test/templates/weather_panel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6911d1517de261_77321951',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a6ee78abc3a0bf397a2e9de171266e527828aec' => 
    array (
      0 => '/home/minh/Test/templates/weather_panel.tpl',
      1 => 1762775216,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6911d1517de261_77321951 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="panel panel-default" style="background-color: transparent; border: 2px solid #ccc;">
    <div style="background-color: transparent;color: #ccc;" class="panel-heading text-center">
        <h1>🌤️ Weather for <?php echo $_smarty_tpl->tpl_vars['city']->value->getName();?>
</h1>
    </div>
    <div class="panel-body">
        <p><strong>API:</strong> <?php echo $_smarty_tpl->tpl_vars['history']->value->getApi();?>
</p>
        <p><strong>Temperature:</strong> <?php echo $_smarty_tpl->tpl_vars['history']->value->getTemperature();?>
 °C</p>
        <p><strong>Humidity:</strong> <?php echo $_smarty_tpl->tpl_vars['history']->value->getHumidity();?>
%</p>
    </div>
</div>
<?php }
}
