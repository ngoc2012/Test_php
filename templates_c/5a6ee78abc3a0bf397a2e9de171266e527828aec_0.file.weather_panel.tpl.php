<?php
/* Smarty version 3.1.48, created on 2025-11-10 12:07:07
  from '/home/minh/Test/templates/weather_panel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6911c75b85e672_95839945',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a6ee78abc3a0bf397a2e9de171266e527828aec' => 
    array (
      0 => '/home/minh/Test/templates/weather_panel.tpl',
      1 => 1762772527,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6911c75b85e672_95839945 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="panel panel-default" style="background-color: transparent; border: 2px solid #ccc;">
    <div style="background-color: transparent;color: #ccc;" class="panel-heading text-center">
        <h1>🌤️ Weather for <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['city']->value->getName(), ENT_QUOTES, 'UTF-8', true);?>
</h1>
    </div>
    <div class="panel-body">
        <p><strong>API:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['history']->value->getApi(), ENT_QUOTES, 'UTF-8', true);?>
</p>
        <p><strong>Temperature:</strong> <?php echo $_smarty_tpl->tpl_vars['history']->value->getTemperature();?>
 °C</p>
        <p><strong>Humidity:</strong> <?php echo $_smarty_tpl->tpl_vars['history']->value->getHumidity();?>
%</p>
    </div>
</div>
<?php }
}
