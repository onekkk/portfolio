<?php
session_start();
$dbh = new PDO('mysql:host=localhost;dbname=bbs', 'root', 'ichimura');
$username;
$password;
$error = "";
$token;
function generate_token()
{
    return hash('sha256', session_id());
}
$token = generate_token();
if (isset($_POST["signup"])){

	if($token != htmlspecialchars($_POST["token"])){
		header("Location:./user_login.php");
                exit;

	}
	

	if(!empty($_POST["username"]) && !empty($_POST["password"])){
		$username = htmlspecialchars($_POST["username"]);
		$password = htmlspecialchars($_POST["password"]);
		$sth = $dbh->prepare('SELECT * FROM user WHERE username=?');
		$sth->execute(array($username));
		$result = $sth->fetch();
		print_r($result["username"]);
		if($result['username'] == $username && password_verify($password, $result['password'])){
			session_regenerate_id(true);
			$_SESSION['username'] = $username;
			header("Location:./internetform.php");
                	exit;
		}else{
			$error = "IDもしくはパスワードが間違っています。";
		}	

	}else{
		$error = "正しい値が入力されていません";		
	}
}


?>


<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="user_login.css">
</head>

<body>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">

	<form id="form" action="" method="post" class="form-horizontal">
		<label class="col-sm-12 control-label" for="InputName" id="title">ログイン</label>
		<div class="form-group">
			<label class="col-sm-12 control-label" for="InputName">ユーザーID</label>
				<div class="col-sm-12">
				<input type="text" name="username" class="form-control" pattern="^[0-9A-Za-z]+$" title="半角英数字で入力して下さい。">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-12 control-label" for="InputTextarea">パスワード</label>	
			<div class="col-sm-12">
				<input type="password" name="password" class="form-control">
				<input type="hidden" name="token" value="<?php echo generate_token() ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-12">
				<div class="right">
					<a href="user_registration.php">登録ページ</a>
					<input type="submit" value="ログイン" name="signup" class="btn btn-info">
				</div>
				<p><?php echo $error ?> </p>
			</div>
		</div>
	</form>
	
	
</div>
<div class="col-md-3 col-xs-0"></div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>






