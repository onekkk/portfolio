<?php
        require_once('init.php');
        $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');

        $login_status;
        $login_name = "";
        $login_status_text = "";
	$list_text;
        $user_name = "不明";
        $user_body = "";
        $follow_text = "";
        $follow_is;

        //ログインチェック
	$login_status = login_check();
        if($login_status){
                $login_name = $_SESSION["username"];
                $login_status_text = $login_name . "でログイン中";
        	$list_text = list_array();
                $login_list = array("link" => "user_logout.php", "text" => "ログアウト");
	}else{
                $login_status_text = "未ログイン";
        	$login_list = array("link" => "user_login.php", "text" => "ログイン");
	}
	$smarty_obj->assign("login_status", $login_status_text);
        $smarty_obj->assign("list_text", $list_text);
        $smarty_obj->assign("login_list", $login_list);



        $sth = $dbh->prepare('SELECT item_id FROM bookmark WHERE user = ? ORDER BY id DESC LIMIT 20;');
        $sth->execute(array($login_name));
        $result = $sth->fetchAll();

	$spots = array();
	$sth = $dbh->prepare('SELECT * FROM spot_items WHERE id = ?;');
	foreach($result as $line){
		$sth->execute(array($line['item_id']));
        	$result1 = $sth->fetch();
		$spots[] = $result1;
	}
	foreach($spots as &$line){
                $body_str = mb_strimwidth($line['body'],0,68);
                if(mb_strlen($body_str) > 34){
                        $body_str .= "…";
                }
                $line['body'] = $body_str;
        }
        unset($line);
	$smarty_obj->assign("spots", $spots);

$smarty_obj->display("bookmark_list.tpl");

