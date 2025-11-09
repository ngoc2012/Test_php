<?php
/* Smarty version 3.1.48, created on 2025-11-09 15:39:48
  from '/home/minh-ngu/Test_php/templates/error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6910b5c41514c1_40353041',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f56f31543e88bca23481d6fee5feca3d4a779895' => 
    array (
      0 => '/home/minh-ngu/Test_php/templates/error.tpl',
      1 => 1762702426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6910b5c41514c1_40353041 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light d-flex align-items-center" style="height:100vh;">

<div class="container text-center">
    <div class="card bg-transparent text-light shadow-sm p-5 mx-auto border-2" style="max-width: 500px;">
        <h1 class="text-danger mb-3">⚠️ Error</h1>
        <p class="lead"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['errorMessage']->value, ENT_QUOTES, 'ISO-8859-1', true);?>
</p>
        <a href="index.php" class="btn btn-outline-light mt-3">Return to Home</a>
    </div>
</div>

<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
