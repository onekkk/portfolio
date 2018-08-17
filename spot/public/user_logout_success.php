<?php
        require_once('init.php');
	
	$login_status = "";
        $list_text;
        $login_list = "";

        $login_status = login_check();
        if($login_status){
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

$smarty_obj->display("user_logout_success.tpl");
