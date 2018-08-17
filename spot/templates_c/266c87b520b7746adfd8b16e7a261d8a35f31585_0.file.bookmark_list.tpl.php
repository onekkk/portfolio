<?php
/* Smarty version 3.1.32, created on 2018-08-17 22:01:12
  from '/var/www/html/items_s/templates/bookmark_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b76c71868bae2_73328496',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '266c87b520b7746adfd8b16e7a261d8a35f31585' => 
    array (
      0 => '/var/www/html/items_s/templates/bookmark_list.tpl',
      1 => 1534510870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b76c71868bae2_73328496 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/user_detail.css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"><?php echo '</script'; ?>
>
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
<div class="row" id="container">
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
                                <h2 class="col-md-12" id="user_info">お気に入り一覧</h2>
                        </div>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['spots']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                                <div class="item">
                                        <a href="item_detail.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" title="" >
                                                <h3><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</h3>
                                                <p class="item_body"><?php echo $_smarty_tpl->tpl_vars['item']->value['body'];?>
</p>
                                                <p class="author">作成者　<?php echo $_smarty_tpl->tpl_vars['item']->value['author'];?>
</p>
                                        </a>
                                </div>
                 <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        </div>
</div>
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
