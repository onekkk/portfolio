<?php
/* Smarty version 3.1.32, created on 2018-08-17 17:56:15
  from '/var/www/html/items_s/templates/add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b768daf158748_93209675',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7370e80e76788394017d60f21282d58341b7c379' => 
    array (
      0 => '/var/www/html/items_s/templates/add.tpl',
      1 => 1534496172,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b768daf158748_93209675 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/add.css">
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
                        <a class="nav-link" href="user_logout.php"><?php echo $_smarty_tpl->tpl_vars['login_list']->value;?>
</a>
		</nav>
	</div>
	<div class="col-md-10">
		<div class="row">
			<div class="col-md-12">
				<h2>スポットを登録</h2>
				<form action="" method="post">
					<?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>

					<label>アイテムの名前：<input type="text" name="item_name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"></label><br>
				    <label>アイテムの説明：<textarea name="item_body" id="" cols="30" rows="3"><?php echo $_smarty_tpl->tpl_vars['item']->value['body'];?>
</textarea><br /></label>
				    <div class="spot" id="spot_1">
					    <h3>１つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_1" id="name" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[0]['name'];?>
"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_1" id="" cols="30" rows="3"><?php echo $_smarty_tpl->tpl_vars['spot']->value[0]['body'];?>
</textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_1" id="google_map_lat_1" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[0]['lat'];?>
"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_1" id="google_map_lng_1" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[0]['lng'];?>
"></label><br>
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(1);">
				    </div>
				    <div id="wrap_map">
				        <input type="text" id="address" value="東京スカイツリー">
				        <input type="button" id="btn" value="検索" class="btn btn-secondary">
						<div id="map" style="width:635px; height:400px;">
						</div>
				    </div>
				    <div class="spot" id="spot_2">
				    	<h3>２つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_2" id="name" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[1]['name'];?>
"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_2" id="" cols="30" rows="3"><?php echo $_smarty_tpl->tpl_vars['spot']->value[1]['body'];?>
</textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_2" id="google_map_lat_2" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[1]['lat'];?>
"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_2" id="google_map_lng_2" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[1]['lng'];?>
"></label><br>
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(2);">
					</div>
					<div class="spot" id="spot_3">
				    	<h3>3つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_3" id="name" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[2]['name'];?>
"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_3" id="" cols="30" rows="3"><?php echo $_smarty_tpl->tpl_vars['spot']->value[2]['body'];?>
</textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_3" id="google_map_lat_3" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[2]['lat'];?>
"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_3" id="google_map_lng_3" value="<?php echo $_smarty_tpl->tpl_vars['spot']->value[2]['lng'];?>
"></label><br>
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(3);">
					</div>
				    
				    <label id="spot_append"><input type="button" value="スポットを追加" class="btn btn-outline-warning" onclick="spot_add();">      ※１０個まで追加できます</label><br>
					<input type="hidden" value="3" id="count" name="count">
				    <input type="submit" value="スポットを登録" name="add" class="float-right btn btn-success">
					<input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['csrf_token']->value;?>
">
					<input type="hidden" name="spot_hidden_4" id="spot_hidden_4" value="<?php if ($_smarty_tpl->tpl_vars['total_count']->value >= 4) {?> <?php echo $_smarty_tpl->tpl_vars['spot']->value[3]['name'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[3]['body'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[3]['lat'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[3]['lng'];
}?>">
					<input type="hidden" name="spot_hidden_5" id="spot_hidden_5" value="<?php if ($_smarty_tpl->tpl_vars['total_count']->value >= 5) {?> <?php echo $_smarty_tpl->tpl_vars['spot']->value[4]['name'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[4]['body'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[4]['lat'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[4]['lng'];
}?>">
					<input type="hidden" name="spot_hidden_6" id="spot_hidden_6" value="<?php if ($_smarty_tpl->tpl_vars['total_count']->value >= 6) {?> <?php echo $_smarty_tpl->tpl_vars['spot']->value[5]['name'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[5]['body'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[5]['lat'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[5]['lng'];
}?>">
					<input type="hidden" name="spot_hidden_7" id="spot_hidden_7" value="<?php if ($_smarty_tpl->tpl_vars['total_count']->value >= 7) {?> <?php echo $_smarty_tpl->tpl_vars['spot']->value[6]['name'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[6]['body'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[6]['lat'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[6]['lng'];
}?>">
					<input type="hidden" name="spot_hidden_8" id="spot_hidden_8" value="<?php if ($_smarty_tpl->tpl_vars['total_count']->value >= 8) {?> <?php echo $_smarty_tpl->tpl_vars['spot']->value[7]['name'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[7]['body'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[7]['lat'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[7]['lng'];
}?>">
					<input type="hidden" name="spot_hidden_9" id="spot_hidden_9" value="<?php if ($_smarty_tpl->tpl_vars['total_count']->value >= 9) {?> <?php echo $_smarty_tpl->tpl_vars['spot']->value[8]['name'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[8]['body'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[8]['lat'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[8]['lng'];
}?>">
					<input type="hidden" name="spot_hidden_10" id="spot_hidden_10" value="<?php if ($_smarty_tpl->tpl_vars['total_count']->value >= 10) {?> <?php echo $_smarty_tpl->tpl_vars['spot']->value[9]['name'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[9]['body'];?>
 , <?php echo $_smarty_tpl->tpl_vars['spot']->value[9]['lat'];?>
,<?php echo $_smarty_tpl->tpl_vars['spot']->value[9]['lng'];
}?>">
				</form>
			</div>
		</div>
		
	</div>
</div>


<?php echo '<script'; ?>
>
var total_count = 3;
function spot_add(){

    if(total_count <= 10){
        total_count++;
        var spot_id = "#spot_" + total_count;
        $('#spot_append').before('<div class="spot" id="spot_' + total_count + '">');
        $(spot_id).append('<h3>' + total_count + 'つ目</h3>');
        $(spot_id).append('<label>おすすめスポットの名前：<input type="text" name="spot_name_' + total_count +'" id="spot_name_' + total_count +'"></label><br>');
        $(spot_id).append('<label>おすすめスポットの説明：<textarea name=" spot_body_' + total_count + '" id="spot_body_' + total_count + '" cols="30" rows="3"></textarea></label><br>');
        $(spot_id).append('<label>おすすめスポットの緯度：<input type="text" name="spot_lat_' + total_count  +'" id="google_map_lat_' + total_count + '" value=""></label><br>');
        $(spot_id).append('<label>おすすめスポットの経度：<input type="text" name="spot_lng_' + total_count  + '" id="google_map_lng_' + total_count + '" value=""></label><br>');
        $(spot_id).append('<input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(' + total_count + ');">');
    }
	if(total_count == 4){
		 $('#spot_append').after('<label id="spot_del" class="col-md-12"><input type="button" value="スポットを削除" class="btn btn-outline-secondary" id="del_btn" onclick="spot_del();"></label>');
	}

    if(total_count >= 10){
        $('#spot_append').remove();
    }
	document.getElementById("count").value = total_count;
}

function spot_del(){
	var spot_id = "#spot_" + total_count;
	$(spot_id).remove();
	total_count--;
	if(total_count == 3){
                $('#del_btn').remove();
        }

	if(total_count == 9){
		$('#spot_del').before('<label id="spot_append"><input type="button" value="スポットを追加" class="btn btn-outline-warning" onclick="spot_add();">      ※１０個まで追加できます</label><br>');
	}

	document.getElementById("count").value = total_count;
}



<?php echo $_smarty_tpl->tpl_vars['script']->value;?>




if(total_count >= 4){
	for(var i = 4; i <= total_count; i++){
		var spot_hidden = 'spot_hidden_' + i;
		var spot_name = 'spot_name_' + i;
		var spot_body = 'spot_body_' + i;
		var google_map_lat = 'google_map_lat_' + i;
		var google_map_lng = 'google_map_lng_' + i;
		
        	var spot_hidden = document.getElementById('spot_hidden_' + i).value;
        	spot_hidden = spot_hidden.split(',');
        	document.getElementById('spot_name_' + i).value = spot_hidden[0];
        	document.getElementById('spot_body_' + i).value = spot_hidden[1];
		if(!isNaN(parseFloat(spot_hidden[2]))){
			document.getElementById('google_map_lat_' + i).value = parseFloat(spot_hidden[2]);
		}
		if(!isNaN(parseFloat(spot_hidden[3]))){
                        document.getElementById('google_map_lng_' + i).value = parseFloat(spot_hidden[3]);
                }
	
	}

}

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript" src="../js/map.js"><?php echo '</script'; ?>
>				    
<?php echo '<script'; ?>
 async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSEHZrMXeXRx-z0heZfwOpt4A31YtSgZE&callback=initMap">
<?php echo '</script'; ?>
>
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
