<?php
/* Smarty version 3.1.48, created on 2025-11-10 12:54:47
  from '/home/minh/Test/templates/list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6911d287de9e56_11121729',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70498f947fab10a08f699904c5a1fe72bb8b62f4' => 
    array (
      0 => '/home/minh/Test/templates/list.tpl',
      1 => 1762775117,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6911d287de9e56_11121729 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['weather_panel']->value;?>


<h1 class="text-center" style="margin-bottom: 30px;">🌍 All Cities</h1>

<div class="panel panel-default" style="background-color: transparent;border: none;">
    <div class="panel-body" style="padding: 0;">
        <ul class="list-group">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cities']->value, 'city');
$_smarty_tpl->tpl_vars['city']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['city']->value) {
$_smarty_tpl->tpl_vars['city']->do_else = false;
?>
                <li class="list-group-item" style="background-color: #343a40; color: #f8f9fa; border: 1px solid #6c757d;">
                    <div style="display: table; width: 100%;">
                        <!-- Name on the left -->
                        <span style="display: table-cell; font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['city']->value->getName();?>
</span>

                        <!-- Buttons on the right -->
                        <div style="display: table-cell; text-align: right; white-space: nowrap;">
                            <a href="index.php?name=<?php echo $_smarty_tpl->tpl_vars['city']->value->encodeCityName();?>
&id=<?php echo $_smarty_tpl->tpl_vars['city']->value->getId();?>
&api=OpenWeatherApi" 
                               class="btn btn-info btn-xs" style="margin-left: 5px;">
                                Open Weather
                            </a>

                            <a href="index.php?name=<?php echo $_smarty_tpl->tpl_vars['city']->value->encodeCityName();?>
&id=<?php echo $_smarty_tpl->tpl_vars['city']->value->getId();?>
&api=FreeWeatherApi" 
                               class="btn btn-info btn-xs" style="margin-left: 5px;">
                                Free Weather
                            </a>
                        </div>
                    </div>
                </li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
</div>

<div class="text-center" style="margin-top: 30px;">
    <p style="color: #6c757d;">Select a city to view the latest weather 🌦️</p>
</div>
<?php }
}
