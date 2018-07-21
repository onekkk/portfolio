<?php
session_start();
$dbh = new PDO('mysql:host=localhost;dbname=bbs', 'root', 'ichimura');
$name;
$body;
$time;
$error = "";
$login = "";
$token;
function generate_token()
{   
    return hash('sha256', session_id());
}
$token = generate_token();

if(isset($_SESSION['username'])){
	$login = $_SESSION["username"] . "でログイン中";
}else{
	$login = "未ログイン";
}

if(isset($_POST['signup'])){
	
	if($token != htmlspecialchars($_POST["token"])){
                header("Location:./internetform_contribution.php");
                exit;
        
        }

	if(isset($_SESSION['username']) && !empty($_POST["text"])){
        	$timestamp = time();
        	$name = $_SESSION["username"];
		$body = str_replace(PHP_EOL, '', nl2br(htmlspecialchars($_POST['text'], ENT_QUOTES)));
        	$time = date("Y-m-d H:i:s", $timestamp);
        	$sth = $dbh->prepare('INSERT INTO bbs_comment(name, body, post_date) VALUES(?, ?, ?);');
        	$sth->execute(array($name, $body, $time));
		header("Location:./internetform.php");
	}else{
		if(!(isset($_SESSION['username']))){
			$error = "ログインをしてください";
		}else if(empty($_POST["text"])){
			$error = "正しい値が入力されていません";
		}	
	}
}
?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="internetform_contribution.css">
</head>

<body>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
	<p><?php echo $login ?></p>
	<form id="form" action="" method="post" class="form-horizontal">
		<label class="col-sm-3 control-label" for="InputName" id="title">投稿ページ</label>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="InputTextarea">内容</label>	
			<div class="col-sm-12">
				<textarea name="text" class="form-control"></textarea>
				<input type="hidden" name="token" value="<?php echo generate_token() ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-12">
				<div class="right"><input type="submit" value="投稿" id="submit" name="signup"></div>
				<p><?php echo $error ?></p>		
			</div>
		</div>
	</form>
</div>
<div class="col-md-3"></div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>


