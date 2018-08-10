<?php

require_once('init.php');

$item;
$time;
$spot = array();
$author = "不明";
$total_count;
$total_count_m;
$error_flg = -1;
$error_message = "";
$script = "";

$dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');

	$login_status = "";
	$list_text = "";
	$login_list = "";
	
        if(login_check()){
                $login_status = $_SESSION["username"] . "でログイン中";
                $list_text = "
                                <a class=\"nav-link\" href=\"add.php\">スポット登録</a>
                                <a class=\"nav-link\" href=\"user_detail.php\">ユーザー情報</a>
                                <a class=\"nav-link\" href=\"follow_up_list.php\">フォロー一覧</a>
                                <a class=\"nav-link\" href=\"bookmark_list.php\">お気に入り一覧</a>
                                ";
		$login_list = "<a class=\"nav-link\" href=\"user_logout.php\">ログアウト</a>";
        }else{
                $login_status = "未ログイン";
                $login_list = "<a class=\"nav-link\" href=\"user_login.php\">ログイン</a>";
        }

	if(isset($_POST['add'])){		

		$total_count = (int) htmlspecialchars($_POST['count']);
		$total_count_m = $total_count-1;
		for($i = 0; $i < $total_count-3; $i++){
			$script .= "spot_add();";
		}
		for($i = 0; $i < $total_count; $i++){
                        $post_name = 'spot_name_';
                        $post_name .= $i+1;
                        $post_body = 'spot_body_';
                        $post_body .= $i+1;
                        $post_lat = 'spot_lat_';
                        $post_lat .= $i+1;
                        $post_lng = 'spot_lng_';
                        $post_lng .= $i+1;
			
			$array = array(
					'name' => htmlspecialchars($_POST[$post_name], ENT_QUOTES),
					'body' => htmlspecialchars($_POST[$post_body], ENT_QUOTES),
					'lat'  => htmlspecialchars($_POST[$post_lat], ENT_QUOTES),
					'lng'  => htmlspecialchars($_POST[$post_lng], ENT_QUOTES)
					);
			
			$spot[] = $array;
			
		}
		$item = array(
				'name' => htmlspecialchars($_POST['item_name'], ENT_QUOTES),
                                'body' => htmlspecialchars($_POST['item_body'], ENT_QUOTES),
				'token' => htmlspecialchars($_POST['token'], ENT_QUOTES)
				);
		if(!token_check($item['token'])){
			$error_flg = 0;
		}
		if(empty($item['name']) || empty($item['body'])){
                                $error_flg = 1;
                }

		$total_count = (int) htmlspecialchars($_POST['count']);
		for($i = 0; $i < $total_count; $i++){
			if(empty($spot[$i]['name']) || empty($spot[$i]['body']) || empty($spot[$i]['lat']) || empty($spot[$i]['body'])){
				$error_flg = 1;
				break;
			}
	
			if(!preg_match("/^[-]?[0-9]+(\.[0-9]+)?$/", $spot[$i]['lat']) || !preg_match("/^[-]?[0-9]+(\.[0-9]+)?$/", $spot[$i]['lng'])){
                                $error_flg = 2;
				break;
                        }
		}
		if($error_flg == 0){
			$error_message = '<p id="error" class="alert alert-danger"><strong>不正な送信です。</strong></p>';
		}else if($error_flg == 1){
			$error_message = '<p id="error" class="alert alert-danger"><strong>未入力の値があります</strong></p>';	
		}else if($error_flg == 1){
                        $error_message = '<p id="error" class="alert alert-danger"><strong>緯度か経度に不正な値が入力されています。</strong></p>';
                }else{
			$timestamp = time();
			$time = date("Y-m-d H:i:s", $timestamp);
			$author = $_SESSION['username'];
			$sth = $dbh->prepare('INSERT INTO spot_items(author, name, body, post_date) VALUES(?, ?, ?, ?);');
			$sth->execute(array($author, $item['name'], $item['body'], $time));
			
			$sth = $dbh->prepare('SELECT MAX(id) FROM spot_items');
			$sth->execute();
			$result = $sth->fetch();
			$sth = $dbh->prepare('INSERT INTO items_detail(item_id, name, body, lat, lng) VALUES(?, ?, ?, ?, ?);');
                        for($i = 0; $i < $total_count; $i++){
				$sth->execute(array($result[0], $spot[$i]['name'], $spot[$i]['body'], $spot[$i]['lat'], $spot[$i]['lng']));
			}
			header("Location:./add_success.php");
			
		}	
		
	}


?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/add.css">
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</head>

<body>
<div class="row">
	<div class="col-md-12">
		<header>
			<h1>タイトル</h1>
			<p id="login_status"><?php echo $login_status; ?></p>
		</header><!-- /header -->
	</div>
</div>
<div class="row" id="container">
	<div class="col-md-2">
		<nav class="nav flex-column">
		  	<a class="nav-link active" href="index.php">ホーム</a>
			<?php echo $list_text; ?>
                        <?php echo $login_list; ?>
		</nav>
	</div>
	<div class="col-md-10">
		<div class="row">
			<div class="col-md-12">
				<h2>スポットを登録</h2>
				<form action="" method="post">
					<?php echo $error_message?>
					<label>アイテムの名前：<input type="text" name="item_name" id="name" value="<?php echo $item['name']; ?>"></label><br>
				    <label>アイテムの説明：<textarea name="item_body" id="" cols="30" rows="3"><?php echo $item['body']; ?></textarea><br /></label>
				    <div class="spot" id="spot_1">
					    <h3>１つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_1" id="name" value="<?php echo $spot[0]['name']; ?>"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_1" id="" cols="30" rows="3"><?php echo $spot[0]['body']; ?></textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_1" id="google_map_lat_1" value="<?php echo $spot[0]['lat']; ?>"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_1" id="google_map_lng_1" value="<?php $spot[0]['lng'] ?>"></label><br>
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
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_2" id="name" value="<?php echo $spot[1]['name']; ?>"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_2" id="" cols="30" rows="3"><?php echo $spot[1]['body']; ?></textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_2" id="google_map_lat_2" value="<?php echo $spot[1]['lat']; ?>"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_2" id="google_map_lng_2" value="<?php echo $spot[1]['lng']; ?>"></label><br>
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(2);">
					</div>
					<div class="spot" id="spot_3">
				    	<h3>3つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_3" id="name" value="<?php echo $spot[2]['name']; ?>"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_3" id="" cols="30" rows="3"><?php echo $spot[2]['body']; ?></textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_3" id="google_map_lat_3" value="<?php echo $spot[2]['lat']; ?>"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_3" id="google_map_lng_3" value="<?php echo $spot[2]['lng']; ?>"></label><br>
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(3);">
					</div>
				    
				    <label id="spot_append"><input type="button" value="スポットを追加" class="btn btn-outline-warning" onclick="spot_add();">      ※１０個まで追加できます</label><br>
					<input type="hidden" value="3" id="count" name="count">
				    <input type="submit" value="スポットを登録" name="add" class="float-right btn btn-success">
					<input type="hidden" name="token" value="<?php echo generate_token()?>">
					<input type="hidden" name="spot_hidden_4" id="spot_hidden_4" value="<?php if ($total_count >= 4) echo $spot[3]['name'].','.$spot[3]['body'].','.$spot[3]['lat'].','.$spot[3]['lng']; ?>">
					<input type="hidden" name="spot_hidden_5" id="spot_hidden_5" value="<?php if ($total_count >= 5) echo $spot[4]['name'].','.$spot[4]['body'].','.$spot[4]['lat'].','.$spot[4]['lng']; ?>">
					<input type="hidden" name="spot_hidden_6" id="spot_hidden_6" value="<?php if ($total_count >= 6) echo $spot[5]['name'].','.$spot[5]['body'].','.$spot[5]['lat'].','.$spot[5]['lng']; ?>">
					<input type="hidden" name="spot_hidden_7" id="spot_hidden_7" value="<?php if ($total_count >= 7) echo $spot[6]['name'].','.$spot[6]['body'].','.$spot[6]['lat'].','.$spot[6]['lng']; ?>">
					<input type="hidden" name="spot_hidden_8" id="spot_hidden_8" value="<?php if ($total_count >= 8) echo $spot[7]['name'].','.$spot[7]['body'].','.$spot[7]['lat'].','.$spot[7]['lng']; ?>">
					<input type="hidden" name="spot_hidden_9" id="spot_hidden_9" value="<?php if ($total_count >= 9) echo $spot[8]['name'].','.$spot[8]['body'].','.$spot[8]['lat'].','.$spot[8]['lng']; ?>">
					<input type="hidden" name="spot_hidden_10" id="spot_hidden_10" value="<?php if ($total_count >= 10) echo $spot[9]['name'].','.$spot[9]['body'].','.$spot[9]['lat'].','.$spot[9]['lng']; ?>">
				</form>
			</div>
		</div>
		
	</div>
</div>


<script>
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


<?php echo $script ?>

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

</script>
<script type="text/javascript" src="js/map.js"></script>				    
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSEHZrMXeXRx-z0heZfwOpt4A31YtSgZE&callback=initMap">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>



