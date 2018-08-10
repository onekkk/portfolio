<?php

require_once('init.php');

$dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');
$username;
$password;
$token;
$error_message = "";

$login_status = "";
$list_text = "";
$login_list = "";

        if(login_check()){
                $login_status = $_SESSION["username"] . "でログイン中";
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


if (isset($_POST["login"])){

        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $token = htmlspecialchars($_POST["token"]);

        if(!token_check($token)){
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

        
}

?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/user_login.css">
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
<div class="row">
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
                                <form action="" method="post">
                                        <h2>ユーザーログイン</h2>
                                        <?php echo $error_message; ?>
                                        <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">ユーザー名</label>
                                                <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="username"id="name" pattern="^[0-9A-Za-z]+$" placeholder="ユーザー名" value="<?php echo $username; ?>">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="password" class="col-sm-2 col-form-label">パスワード</label>
                                                <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="パスワード" value="<?php echo $password; ?>">
</div>
                                        </div>
					<div class="float-right">
						<a href="user_sign_up.php" id="sign_in">新規登録</a>
                                        	<input type="submit" class=" float-right btn btn-primary" id="login" name="login" value="ログイン">
					</div>
                                        <input type="hidden" name="token" value="<?php echo generate_token() ?>">
                                </form>
                        </div>
                </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>


