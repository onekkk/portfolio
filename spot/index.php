<?php
	require_once('init.php');
	$dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');
	
	$serach_text = "";
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
	$sql = "";
	$sql_count = "";
	if (isset($_POST["serach"])){
		$serach_text = htmlspecialchars($_POST["serach_text"]);
		$serach_text_sql = "WHERE name LIKE '%" . $serach_text . "%' OR body LIKE '%" . $serach_text . "%' ";
		$sql = "SELECT * FROM spot_items " . $serach_text_sql . "ORDER BY id DESC";
		$sql_count = "SELECT COUNT(*) FROM spot_items " . $serach_text_sql . "ORDER BY id DESC;";
	}else{
		$sql = 'SELECT * FROM spot_items ORDER BY id DESC';
		$sql_count = 'SELECT COUNT(*) FROM spot_items ORDER BY id DESC;';
	}

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
<!--<link rel="stylesheet" type="text/css" href="index.css">-->
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
		  	<a class="nav-link active" href="">ホーム</a>
			<?php echo $add_list; ?>
			<?php echo $login_list; ?>
		</nav>
	</div>
	<div class="col-md-10">
		<div class="row">
			<form action="" method="post" class="col-md-12">
				<div class="input-group" id="serach_bar">
  					<input type="text" class="form-control" name="serach_text" placeholder="" value="<?php echo $serach_text;?>">
  					<div class="input-group-append">
    						<input class="btn btn-primary" type="submit" name="serach" value="検索">
  					</div>
				</div>
			</form>
<?php
	for($i = 0; $i < count($result); $i++){
	$body_str = mb_strimwidth($result[$i]['body'],0,68);
	if(mb_strlen($body_str) > 34){
		$body_str .= "…";
	}
	$n = $i + 1;	
	print("<div class=\"col-md-3 item \">
				<form name=\"form" . $n . "\" method=\"post\" action=\"item_detail.php\"> 
                                        <a href=\"javascript:form1.submit()\" title=\"\">
                                                <h3>". $result[$i]['name']."</h3>
                                                <p class=\"item_body\">" . $body_str ."</p>
						<p class=\"author\">作成者　" . $result[$i]['author'] . "</p>
                                        </a>
                                        <input type=hidden name=\"id\" value=\"" . $result[$i]['id']. "\"> 
                                </form>
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>



