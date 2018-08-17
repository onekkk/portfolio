<?php
/* Smarty version 3.1.32, created on 2018-08-17 22:25:03
  from '/var/www/html/items_s/templates/user_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b76ccaf59cee1_81861626',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d27acefabd6408f28949ab1bdbbb85b4838e45d' => 
    array (
      0 => '/var/www/html/items_s/templates/user_detail.tpl',
      1 => 1534512179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b76ccaf59cee1_81861626 (Smarty_Internal_Template $_smarty_tpl) {
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
                        <p id="login_status"><?php echo $_smarty_tpl->tpl_vars['login_status_text']->value;?>
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
				<h2 class="col-md-12" id="user_info">ユーザー情報</h2>
				<div id="info_body">
					<div class="row" id="info_body">
						<p class="col-md-5 body_left">    ユーザー名：</p>
						<p class="col-md-7" description><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['follow_text']->value;?>
</p>
						<p class="col-md-5 body_left">ユーザーの紹介文：</p>
                                                <p class="col-md-7" description><?php echo $_smarty_tpl->tpl_vars['user_body']->value;?>
</p>
					</div>
				</div>
				<h2>投稿一覧</h2>
			</div>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'item');
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


                <div class="col-md-12" id="page">
                	<div class="row">
                        <p class="col-md-4">
                                <?php if ($_smarty_tpl->tpl_vars['page']->value > 1) {?>
                                        <a href="?page=<?php echo ($_smarty_tpl->tpl_vars['page']->value-1);?>
">前のページへ</a>
                                <?php }?>
                        </p>
                        <p class="col-md-4"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 ページ目</p>
                        <p class="col-md-4">
                                <?php if ($_smarty_tpl->tpl_vars['page']->value < $_smarty_tpl->tpl_vars['total_page']->value) {?>
    　　                                <a href="?page=<?php echo ($_smarty_tpl->tpl_vars['page']->value+1);?>
">次のページへ</a>
                                <?php }?>
                        </p>
                        </div>

		</div>
        </div>
</div>

<?php echo '<script'; ?>
>

	$(function(){
            // Ajax button click
            $('#follow_btn').on('click',function(){
		var follow = <?php if ($_smarty_tpl->tpl_vars['follow_is']->value) {?> true <?php } else { ?> false<?php }?>;
		if(this.value == "フォローする"){
                      this.value = "フォローをはずす"
		      follow = true;
                }else{
                      this.value = "フォローする"
		      follow = false;
                }

                $.ajax({
                    url:'./follow.php',
                    type:'POST',
                    data:{
                    	'follow':"<?php echo $_smarty_tpl->tpl_vars['login_name']->value;?>
",
                        'follower':"<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
",
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
            });
        });

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
