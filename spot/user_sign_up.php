<?php

require_once('init.php');

$dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');
$username;
$password;
$token;
$error_message = "";

	$login_status = "";
        $login_list = "";
        $add_list = "";

        if(isset($_SESSION['username'])){
                $login_status = $_SESSION["username"] . "でログイン中";
                $login_list = "<a class=\"nav-link\" href=\"user_logout.php\">ログアウト</a>";
                $add_list = "<a class=\"nav-link\" href=\"add.php\">スポット登録</a>";
        }else{
                $login_status = "未ログイン";
                $login_list = "<a class=\"nav-link\" href=\"user_login.php\">ログイン</a>";
        }




if (isset($_POST["sign_up"])){
	
	$username = htmlspecialchars($_POST["username"]);
	$password = htmlspecialchars($_POST["password"]);
	$token = htmlspecialchars($_POST["token"]);
	
	if(!token_check($token)){
		$error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>不正な送信です。</strong></p>";
	}else if(empty($_POST["username"]) || empty($_POST["password"])){
		$error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>正しい値が入力されていません</strong></p>";
	}else{
		
		$sth = $dbh->prepare('SELECT COUNT(*) FROM user WHERE username=?;');
                $sth->execute(array($username));
                $result = $sth->fetch();
		$check = (int) $result[0];
		if($check!= 0){
			$error_message = "<p id=\"error\" class=\"alert alert-danger\"><strong>すでにユーザーIDが登録されています。</strong></p>";
		}else{
		
                	$password = password_hash($password, PASSWORD_DEFAULT);
                	$sth = $dbh->prepare('INSERT INTO user(username, password) VALUES(?, ?);');
                	$sth->execute(array($username, $password));
			var_dump($sth);
                	$error_mesage = "";
               		header("Location:./index.php");
               		exit;
		}

	}
}

?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/user_sign_up.css">
</head>

<body>
<div class="row">
	<div class="col-md-12">
		<header>
			<h1>タイトル</h1>
		</header><!-- /header -->
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<nav class="nav flex-column">
		  	<a class="nav-link active" href="index.php">ホーム</a>
			<?php echo $add_list; ?>
                        <?php echo $login_list; ?>
		</nav>
	</div>
	<div class="col-md-10">
		<div class="row">
			<div class="col-md-12">
				<form action="" method="post">
					<h2>新規登録</h2>
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
					<input type="submit" class=" float-right btn btn-primary" id="sign_up" name="sign_up" value="登録">
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




