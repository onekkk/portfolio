<?php
        require_once('init.php');
        $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');

        $login_status;
	$login_name = "";
	$login_status_text = "";
	$list_text = "";
	$login_list = "";
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
	
	//ユーザーの取得
	if(isset($_GET['user'])){
		$user_name = htmlspecialchars($_GET['user'], ENT_QUOTES);
	}else{
		$user_name = $login_name;
	}

	//ユーザがフォローしているかのチェック
        $sth = $dbh->prepare('SELECT COUNT(*) FROM follow WHERE follow = ? && follower = ? ;');
        $sth->execute(array($login_name, $user_name));
        $result = $sth->fetch();
        //フォローしている場合true
        if($result[0] != '0'){
                $follow_is = true;
        }else{
                $follow_is = false;
        }
	$follow_text = "";
	if($follow_is){
		$follow_is_text = "フォローはずす";
	}else{
		$follow_is_text = "フォローする";
	}
	//フォローボタンの表示
	if($login_status == true && $user_name != $_SESSION["username"]){
		$follow_text = "<input type=\"button\" class=\"btn btn-outline-primary\" id=\"follow_btn\" value=\"" . $follow_is_text . "\">";
	}

	$sql = 'SELECT id, body FROM user WHERE username LIKE "' . $user_name . '";';
	$sth = $dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetch();
	$user_body = $result['body'];
                
	$sql = 'SELECT * FROM spot_items WHERE author LIKE "' . $user_name .'" ORDER BY id DESC';
        $sql_count = 'SELECT COUNT(*) FROM spot_items WHERE author LIKE "' . $user_name . '";';

        $sth = $dbh->prepare($sql_count);
        $sth->execute(array());
        $result = $sth->fetch();

        $total_item = (int) $result[0];
        $display_item = 20;//一ページ内に表示するアイテム数
        $total_page;
        if($total_item <= $display_item){
                $total_page = 1;
        }else if ($total_item % $display_item == 0){
                $total_page = $total_item / $display_item;
        }else{
                $total_page = $total_item / $display_item + 1;
        }
        $total_page = (int) $total_page;
        $page = htmlspecialchars($_GET["page"]);

        if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $total_page) {
                $page = (int)$page;
        } else {
                $page = 1;
        }

        $display_count_current = ($page - 1) * $display_item ;
        $sql .= " LIMIT " . $display_count_current . "," . $display_item . ";";

        $sth = $dbh->prepare($sql);
        $sth->execute(array());
        $result = $sth->fetchAll();
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
				<h2 class="col-md-12" id="user_info">ユーザー情報</h2>
				<div id="info_body">
					<div class="row" id="info_body">
						<p class="col-md-5 body_left">    ユーザー名：</p>
						<p class="col-md-7" description><?php echo $user_name; echo $follow_text; ?></p>
						<p class="col-md-5 body_left">ユーザーの紹介文：</p>
                                                <p class="col-md-7" description><?php echo $user_body; ?></p>
					</div>
				</div>
				<h2>投稿一覧</h2>
			</div>
<?php
        for($i = 0; $i < count($result); $i++){
        $body_str = mb_strimwidth($result[$i]['body'],0,68);
        if(mb_strlen($body_str) > 34){
                $body_str .= "…"; 
        }       
        $n = $i + 1;
        print("<div class=\"item \">
                                        <a href=\"item_detail.php?id=".$result[$i]['id']." title=\"\">
                                                <h3>". $result[$i]['name']."</h3>
                                                <p class=\"item_body\">" . $body_str ."</p>
                                                <p class=\"author\">作成者　" . $result[$i]['author'] . "</p>
                                        </a>
                        </div>");
}

?>

                <div class="col-md-12" id="page">
                        <div class="row">
                        <p class="col-md-4">
                                <?php if ($page > 1) : ?>
                                        <a href="?page=<?php echo ($page - 1); ?>">前のページへ</a>
                                <?php endif; ?>
                        </p>
                        <p class="col-md-4"><?php echo $page; ?> ページ目</p>
                        <p class="col-md-4">
                                <?php if ($page < $total_page) : ?>
    　　                                <a href="?page=<?php echo ($page + 1); ?>">次のページへ</a>
                                <?php endif; ?>
                        </p>
                        </div>
                </div>
        </div>
</div>
<script>

	$(function(){
            // Ajax button click
            $('#follow_btn').on('click',function(){
		var follow = <?php if($follow_is) {echo "true";}else{echo "false";}?>;
		if(this.value == "フォローする"){
                      this.value = "フォローをはずす"
		      follow = true;
                }else{
                      this.value = "フォローする"
		      follow = false;
                }

                $.ajax({
                    url:'./follow.php',
                    type:'POST',
                    data:{
                    	'follow':"<?php echo $_SESSION["username"] ?>",
                        'follower':"<?php echo $user_name ?>",
			'follow_is':follow
			}
                })
                // Ajaxリクエストが成功した時発動
                .done( (data) => {
                    $('.result').html(data);
                    console.log(data);
                })
                // Ajaxリクエストが失敗した時発動
                .fail( (data) => {
                    $('.result').html(data);
                    console.log(data);
                })
                // Ajaxリクエストが成功・失敗どちらでも発動
                .always( (data) => {

                });
            });
        });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>

