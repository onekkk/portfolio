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
                $list_text = "
                                <a class=\"nav-link\" href=\"add.php\">スポット登録</a>
                                <a class=\"nav-link\" href=\"user_detail.php\">ユーザー情報</a>
                                <a class=\"nav-link\" href=\"follow_up_list.php\">フォロー一覧</a>
                                <a class=\"nav-link\" href=\"bookmark_list.php\">お気に入り一覧</a>
                                ";
		$login_list = "<a class=\"nav-link\" href=\"user_logout.php\">ログアウト</a>";
        }else{
                $login_status_text = "未ログイン";
                $login_list = "<a class=\"nav-link\" href=\"user_login.php\">ログイン</a>";
        }


        $sth = $dbh->prepare('SELECT item_id FROM bookmark WHERE user = ? ORDER BY id DESC LIMIT 20;');
        $sth->execute(array($login_name));
        $result1 = $sth->fetchAll();

	$sth = $dbh->prepare('SELECT * FROM spot_items WHERE id = ?;');

?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/user_detail.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
</head>

<body>
<div class="row">
        <div class="col-md-12">
                <header>
                        <h1>タイトル</h1>
                        <p id="login_status"><?php echo $login_status_text; ?></p>
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
                                <h2 class="col-md-12" id="user_info">お気に入り一覧</h2>
                        </div>
<?php
        for($i = 0; $i < count($result1); $i++){
	$id = (int) $result1[$i]['item_id']; 
	$sth->execute(array($id));
	$result2 = $sth->fetch();
        $body_str = mb_strimwidth($result2['body'],0,68);
        if(mb_strlen($body_str) > 34){
                $body_str .= "…";
        }
        $n = $i + 1;
        print("<div class=\"item \">
                                        <a href=\"item_detail.php?id=" . $id . " title=\"\">
                                                <h3>". $result2['name']."</h3>
                                                <p class=\"item_body\">" . $body_str ."</p>
                                                <p class=\"author\">作成者　" . $result2['author'] . "</p>
                                        </a>
                        </div>");
}

?>

        </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>

