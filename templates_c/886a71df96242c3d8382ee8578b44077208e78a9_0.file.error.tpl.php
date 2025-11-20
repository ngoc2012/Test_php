<?php
/* Smarty version 3.1.48, created on 2025-11-20 11:22:48
  from '/home/minh/Test/templates/error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_691eebf8b81d72_92797370',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '886a71df96242c3d8382ee8578b44077208e78a9' => 
    array (
      0 => '/home/minh/Test/templates/error.tpl',
      1 => 1763479370,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691eebf8b81d72_92797370 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container text-center" style="padding-top: 50px; padding-bottom: 50px;">
	<div class="panel panel-default" style="background-color: transparent; border: 2px solid #ccc; max-width: 500px; margin: 0 auto; padding: 40px;">
		<div class="panel-body">
			<h1 class="text-danger" style="margin-bottom: 20px;">⚠️ Error</h1>
			<p class="lead"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['errorMessage']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
			<a href="index.php" class="btn btn-default" style="margin-top: 20px;">Return to Home</a>
		</div>
	</div>
</div>
<?php }
}
