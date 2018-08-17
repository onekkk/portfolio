<?php
        require_once('init.php');
        $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');

        $serach_text = "";
        $login_status = "";
	$list_text = "";
        $login_list = "";
	$login_name = "";

	$login_status = login_check();
        if($login_status){
		$login_name = $_SESSION["username"];
                $login_status = $login_name . "でログイン中";
        	$list_text = list_array();
                $login_list = array("link" => "user_logout.php", "text" => "ログアウト");
	}else{
                $login_status = "未ログイン";
        	$login_list = array("link" => "user_login.php", "text" => "ログイン");
	}

	$smarty_obj->assign("login_name", $login_name);
	$smarty_obj->assign("login_status", $login_status);
        $smarty_obj->assign("list_text", $list_text);
        $smarty_obj->assign("login_list", $login_list);
	
	$sth = $dbh->prepare('SELECT * FROM follow WHERE follow = ?;');
        $sth->execute(array($login_name));
        $result = $sth->fetchAll();
	
	$smarty_obj->assign("result", $result);

$smarty_obj->display("follow_up_list.tpl");



