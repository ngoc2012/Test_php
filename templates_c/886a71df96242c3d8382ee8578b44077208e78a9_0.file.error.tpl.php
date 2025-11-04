<?php
/* Smarty version 3.1.48, created on 2025-11-04 14:34:57
  from '/home/minh/Test/templates/error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690a0101a9e941_92313238',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '886a71df96242c3d8382ee8578b44077208e78a9' => 
    array (
      0 => '/home/minh/Test/templates/error.tpl',
      1 => 1762254212,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690a0101a9e941_92313238 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="error-box">
        <h1>Oops! Something went wrong.</h1>
        <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['error_message']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>
<?php }
}
