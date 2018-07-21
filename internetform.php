<?php
session_start();
$dbh = new PDO('mysql:host=localhost;dbname=bbs', 'root', 'ichimura');
$name;
$body;
$time;
$login = "";
$logout = "";


if(isset($_SESSION['username'])){
	$login = $_SESSION["username"] . "でログイン中";
	$logout = "<a href='user_logout.php' class='btn btn-danger' id='logout'>ログアウト</a>";
}else{
	$login = "未ログイン";
}

?>

<!DOCTYPE>

<html>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="internetform.css">
</head>

<body>
<div class="row">
<div class="col-md-3 col-xs-0"><?php echo $login?></div>
<div class="col-md-6 col-xs-12" id="read">
<div class="left">
	<a href="internetform_contribution.php" class="btn btn-secondary">投稿ページ</a>
	<?php echo $logout ?>
</div>
</body>

</html>


<?php

if(isset($_POST['text'])){
	$timestamp = time();
	$name = str_replace(PHP_EOL, '', nl2br(htmlspecialchars($_POST['name'], ENT_QUOTES)));
	$body = str_replace(PHP_EOL, '', nl2br(htmlspecialchars($_POST['text'], ENT_QUOTES)));
	$time = date("Y-m-d H:i:s", $timestamp);	
	$sth = $dbh->prepare('INSERT INTO bbs_comment(name, body, post_date) VALUES(?, ?, ?);');
	$sth->execute(array($name, $body, $time));
}

$sth = $dbh->prepare('SELECT * FROM bbs_comment ORDER BY id DESC;');
$sth->execute(array(50));
$result = $sth->fetchAll();
foreach($result as $line){
	
	print('<div class="reading">
		<p class="name">' . $line["post_date"] ."  " . $line["name"] .'さん</p>
			<p class="body">' . $line["body"] . '</p>
		</div>');
}

?>
<html>
<body>
</div>
<div class="col-md-3 col-xs-0"></div>
</div>
</body>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>


