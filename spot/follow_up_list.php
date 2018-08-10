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
	
	$sth = $dbh->prepare('SELECT * FROM follow WHERE follow = ?;');
        $sth->execute(array($login_name));
        $result = $sth->fetchAll();



?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/follow_up_list.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
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
		<h2 class="col-md-12">フォロー一覧</h2>
<?php
        foreach ($result as $line){
        print("<div class=\"col-md-12 follow_item\">
			<div class=\"follow_wrap\">
				<a href=\"user_detail.php?user=" . $line['follower'] . "\" class=\" description\">". $line['follower'] . "</a>
				<input type=\"button\" class=\"btn btn-outline-primary\" id=\"f_".$line['follower']."\" value=\"フォローをはずす\" onClick=\"follow_click('".$line['follower']."')\">
			</div>
		</div>");
	}

?>

      </div>        
</div>
<script>
            // Ajax button click
            function follow_click(follower){
                var follow = true;
		var id = "f_" + follower;
                if(document.getElementById(id).value == "フォローする"){
                      document.getElementById(id).value = "フォローをはずす";
                      follow = true;
                }else{
                      document.getElementById(id).value = "フォローする";
                      follow = false;
                }

                $.ajax({
                    url:'./follow.php',
                    type:'POST',
                    data:{
                        'follow':"<?php echo $_SESSION["username"] ?>",
                        'follower':follower,
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
		}



</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>

