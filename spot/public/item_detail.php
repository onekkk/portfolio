<?php
        require_once('init.php');
        $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');

	$login_status = "";
	$login_name;
	$login_status_text;
	$list_text;
	$login_list;
	$bookmark_is;
	$bookmark_text = "";
	

	$login_status = login_check();
	//ログインチェック
        if($login_status){
		$login_name = $_SESSION["username"];
                $login_status_text = $login_name . "でログイン中";
		$list_text = list_array();
		$login_list = array("link" => "user_logout.php", "text" => "ログアウト");
        }else{
                $login_status_text = "未ログイン";
        	$login_list = array("link" => "user_login.php", "text" => "ログイン");
	}
	$smarty_obj->assign("login_name", $login_name);
	$smarty_obj->assign("login_status_text", $login_status_text);
        $smarty_obj->assign("list_text", $list_text);
        $smarty_obj->assign("login_list", $login_list);
	
	$id = (int)htmlspecialchars($_GET['id']);
	//ユーザがお気に入り済かのチェック
        $sth = $dbh->prepare('SELECT COUNT(*) FROM bookmark WHERE user = ? && item_id = ? ;');
        $sth->execute(array($login_name, $id));
        $result = $sth->fetch();
        //お気に入り済の場合true
        if($result[0] != '0'){
                $bookmark_is = true;
        }else{
                $bookmark_is = false;
        }
        $bookmark_is_text = "";
        if($bookmark_is){
                $bookmark_is_text = "お気に入り済";
        }else{
                $bookmark_is_text = "お気に入り";
        }
        //お気に入りボタンの表示
        if($login_status == true){
                $bookmark_text = "<input type=\"button\" class=\"btn btn-outline-success\" id=\"bookmark_btn\" value=\"" . $bookmark_is_text . "\">";
        }
	$smarty_obj->assign("id", $id);
	$smarty_obj->assign("bookmark_text", $bookmark_text);

	$str = "";

        $sth = $dbh->prepare('SELECT * FROM items_detail WHERE item_id = :id;');
	$sth->bindParam(':id', $id);

	//$id = (int)htmlspecialchars($_GET['id']); すでに受け取ってるためコメントアウト
        $sth->execute();
        $result1 = $sth->fetchAll();
	$smarty_obj->assign("result1", $result1);

	$str = "[\n";
	foreach($result1 as $line){
		$str .= "{
       				name: \"" . $line['name'] . "\",
       				lat: " . $line['lat'] . ",
        			lng: " . $line['lng'] . ",
 			},";
	}
	$str .= "]";
	$smarty_obj->assign("str", $str);
	//アイテムの情報取得
	$sql = 'SELECT * FROM spot_items WHERE id= ' . $id . ';';
	$sth = $dbh->prepare('SELECT * FROM spot_items WHERE id= :id;');
	$sth->bindParam(':id', $id);
        $sth->execute();
	$result2 = $sth->fetch();
	$smarty_obj->assign("result2", $result2);

$smarty_obj->display("item_detail.tpl");
