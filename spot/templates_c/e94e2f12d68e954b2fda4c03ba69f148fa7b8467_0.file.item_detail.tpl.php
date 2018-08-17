<?php
/* Smarty version 3.1.32, created on 2018-08-17 22:37:22
  from '/var/www/html/items_s/templates/item_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b76cf92ea5dd8_96677814',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e94e2f12d68e954b2fda4c03ba69f148fa7b8467' => 
    array (
      0 => '/var/www/html/items_s/templates/item_detail.tpl',
      1 => 1534513039,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b76cf92ea5dd8_96677814 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/item_detail.css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	var markerData = <?php echo $_smarty_tpl->tpl_vars['str']->value;?>
;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"><?php echo '</script'; ?>
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
				<h2>アイテムの詳細</h2>

				<div id="content">
					<div class="row">
                                                <p class="col-md-4">アイテムの作成者：</p>
                                                	<a href="user_detail.php?user=<?php echo $_smarty_tpl->tpl_vars['result2']->value['author'];?>
" class="col-md-8  description"><?php echo $_smarty_tpl->tpl_vars['result2']->value['author'];?>
</a>
					</div>
					<div class="row">
					    	<p class="col-md-4">アイテムの名前：</p>
					    	<p class="col-md-8  description"><?php echo $_smarty_tpl->tpl_vars['result2']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['bookmark_text']->value;?>
</p>
					    </div>
					    
					    <div class="row">
					    	<p class="col-md-4">アイテムの説明：</p>
					    	<p class="col-md-8  description"><?php echo $_smarty_tpl->tpl_vars['result2']->value['body'];?>
</p>
					    </div>
					<div id="map" style="width:450px; height:320px;"></div>
	
		<?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result1']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_start = min(0, $__section_i_0_loop);
$__section_i_0_total = min(($__section_i_0_loop - $__section_i_0_start), $__section_i_0_loop);
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = $__section_i_0_start; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
			<div class="spot" id="spot_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
">
                                            <div class="row">
                                                <p class="col-md-4">おすすめスポットの名前：</p>
                                                <p class="col-md-8  description"><?php echo $_smarty_tpl->tpl_vars['result1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name'];?>
</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4">おすすめスポットの説明：</p>
                                                <p class="col-md-8  description"><?php echo $_smarty_tpl->tpl_vars['result1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['body'];?>
</p>
                                            </div>
                                            <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
);">
			<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null) == 0) {?>
				<div id="map_detail" style="width:450px; height:320px;"></div>
			<?php }?>
			
			</div>
		
		<?php
}
}
?>
			</div>
		</div>
	</div>
</div>


<?php echo '<script'; ?>
>
$(function(){
            // Ajax button click
            $('#bookmark_btn').on('click',function(){
                var bookmark_is;
                if(this.value == "お気に入り"){
                      this.value = "お気に入り済"
                      bookmark_is = true;
                }else{
                      this.value = "お気に入り"
                      bookmark_is = false;
                }

                $.ajax({
                    url:'./bookmark.php',
                    type:'POST',
                    data:{
                        'user':"<?php echo $_smarty_tpl->tpl_vars['login_name']->value;?>
",
                        'item_id':"<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
",
                        'bookmark_is':bookmark_is
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
 type="text/javascript" src="../js/display_map.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 async defe
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSEHZrMXeXRx-z0heZfwOpt4A31YtSgZE&callback=initMap">
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
