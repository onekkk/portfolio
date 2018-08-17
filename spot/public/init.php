<?php
session_start();
// Smartyクラスを読み込む
require_once("../smarty/libs/Smarty.class.php");

// Smartyのインスタンスを生成
$smarty_obj = new Smarty();

// テンプレートディレクトリとコンパイルディレクトリを読み込む
$smarty_obj->setTemplateDir(__DIR__.'/../templates/');
$smarty_obj->setCompileDir(__DIR__.'/../templates_c/');



function generate_token()
{
    return hash('sha256', session_id());
}

function token_check($token_post){
	$token = generate_token();
	if($token == $token_post){
		return true;
	}
	return false;
}

function login_check(){
	if(isset($_SESSION['username'])){
                return true;
        }else{
                return false;
        }
}

function list_array(){
	$link = array("add.php", "user_detail.php", "follow_up_list.php", "bookmark_list.php");
	$text = array("スポット登録", "ユーザー情報", "フォロー一覧", "お気に入り一覧");
	$list = array();
	for($i = 0; $i < count($link); $i++){
		$array = array(
			"link" => $link[$i],
			"text" => $text[$i]
		);
		$list[] = $array;
	}
	return $list;
}




