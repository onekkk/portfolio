<?php
/* Smarty version 3.1.32, created on 2018-08-17 19:33:17
  from '/var/www/html/items_s/templates/user_login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b76a46d03d274_91151378',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '672ea405008af0989d83530c06d88940a067e3e0' => 
    array (
      0 => '/var/www/html/items_s/templates/user_login.tpl',
      1 => 1534501966,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b76a46d03d274_91151378 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/user_login.css">
</head>

<body>
<div class="row">
        <div class="col-md-12">
                <header>
                        <h1>タイトル</h1>
			<p id="login_status"><?php echo $_smarty_tpl->tpl_vars['login_status']->value;?>
</p>
                </header><!-- /header -->
        </div>
</div>
<div class="row">
        <div class="col-md-2">
                <nav class="nav flex-column">
                        <a class="nav-link active" href="index.php">ホーム</a>
                	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_text']->value, 'li');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['li']->value) {
?>
                                <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['li']->value["link"];?>
"><?php echo $_smarty_tpl->tpl_vars['li']->value["text"];?>
</a>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['login_list']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['login_list']->value['text'];?>
</a>

		</nav>
        </div>
        <div class="col-md-10">
                <div class="row">
                        <div class="col-md-12">
                                <form action="" method="post">
                                        <h2>ユーザーログイン</h2>
                                        <?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>

                                        <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">ユーザー名</label>
                                                <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="username"id="name" pattern="^[0-9A-Za-z]+$" placeholder="ユーザー名" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="password" class="col-sm-2 col-form-label">パスワード</label>
                                                <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="パスワード" value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
">
</div>
                                        </div>
					<div class="float-right">
						<a href="user_sign_up.php" id="sign_in">新規登録</a>
                                        	<input type="submit" class=" float-right btn btn-primary" id="login" name="login" value="ログイン">
					</div>
                                        <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['csrf_token']->value;?>
">
                                </form>
                        </div>
                </div>
        </div>
</div>

<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"><?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
