<?php

require_once('init.php');

$dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');
$username;
$password;
$token;
$error_message = "";

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

if (isset($_POST["login"])){

        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $token = htmlspecialchars($_POST["token"]);

        if($token != $csrf_token){
                $error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>不正な送信です。</strong></p>";
        }else if(empty($_POST["username"]) || empty($_POST["password"])){
                $error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>正しい値が入力されていません</strong></p>";
        }else{

		$sth = $dbh->prepare('SELECT * FROM user WHERE username=?');
		$sth->execute(array($username));
		$result = $sth->fetch();
		if($result['username'] == $username && password_verify($password, $result['password'])){
			session_regenerate_id(true);
			$_SESSION['username'] = $username;
			header("Location:./index.php");
                	exit;
		}else{
			$error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>IDもしくはパスワードが間違っています。</strong></p>";
		}	
         }
	$smarty_obj->assign("error_message", $error_message);
	$smarty_obj->assign("username", $username);
	$smarty_obj->assign("password", $password);
        
}
$smarty_obj->display("user_login.tpl");
