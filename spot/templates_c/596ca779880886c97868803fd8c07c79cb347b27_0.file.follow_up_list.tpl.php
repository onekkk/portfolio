<?php
/* Smarty version 3.1.32, created on 2018-08-17 22:31:47
  from '/var/www/html/items_s/templates/follow_up_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b76ce43992f41_10774972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '596ca779880886c97868803fd8c07c79cb347b27' => 
    array (
      0 => '/var/www/html/items_s/templates/follow_up_list.tpl',
      1 => 1534512704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b76ce43992f41_10774972 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/follow_up_list.css">
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
		<h2 class="col-md-12">フォロー一覧</h2>

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'line');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['line']->value) {
?>
        	<div class="col-md-12 follow_item">
			<div class="follow_wrap">
				<a href="user_detail.php?user=<?php echo $_smarty_tpl->tpl_vars['line']->value['follower'];?>
" class=" description"><?php echo $_smarty_tpl->tpl_vars['line']->value['follower'];?>
</a>
				<input type="button" class="btn btn-outline-primary" id="f_<?php echo $_smarty_tpl->tpl_vars['line']->value['follower'];?>
" value="フォローをはずす" onClick="follow_click('<?php echo $_smarty_tpl->tpl_vars['line']->value['follower'];?>
');">
			</div>
		</div>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

      </div>        
</div>

<?php echo '<script'; ?>
>
            // Ajax button click
            function follow_click(follower){
                var follow = true;
		var id = "f_" + follower;
                if(document.getElementById(id).value == "フォローする"){
                      document.getElementById(id).value = "フォローをはずす";
                      follow = true;
                }else{
                      document.getElementById(id).value = "フォローする";
                      follow = false;
                }

                $.ajax({
                    url:'./follow.php',
                    type:'POST',
                    data:{
                        'follow':"<?php echo $_smarty_tpl->tpl_vars['login_name']->value;?>
",
                        'follower':follower,
                        'follow_is':follow
                        }
                })
                // Ajaxリクエストが成功した時発動
                .done( (data) => {
                    $('.result').html(data);
                    console.log(data);
		})
                // Ajaxリクエストが失敗した時発動
                .fail( (data) => {
                    $('.result').html(data);
                    console.log(data);
                })
                // Ajaxリクエストが成功・失敗どちらでも発動
                .always( (data) => {

                });
		}



<?php echo '</script'; ?>
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
