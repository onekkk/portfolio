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
$csrf_token = generate_token();
$smarty_obj->assign("csrf_token", $csrf_token);

	$login_status = "";
	$list_text;
	$login_list = "";
	
        if(login_check()){
                $login_status = $_SESSION["username"] . "でログイン中";
                $list_text = list_array();
        	$login_list = array("link" => "user_logout.php", "text" => "ログアウト");
	}else{
                $login_status = "未ログイン";
        	$login_list = array("link" => "user_login.php", "text" => "ログイン");
	}
	$smarty_obj->assign("login_status", $login_status);
        $smarty_obj->assign("list_text", $list_text);
        $smarty_obj->assign("login_list", $login_list);

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
		$smarty_obj->assign("total_count", $total_count);
		$smarty_obj->assign("script", $script);
        	$smarty_obj->assign("spot", $spot);
        	$smarty_obj->assign("item", $item);


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
		$smarty_obj->assign("error_message", $error_message);	
		
	}

$smarty_obj->display("add.tpl");
