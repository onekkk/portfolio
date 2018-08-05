<?php
        require_once('init.php');
        $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');

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


	$str = "";

        $sth = $dbh->prepare('SELECT * FROM items_detail WHERE item_id=?;');
        $sth->execute(array(htmlspecialchars($_POST['id'])));
        $result1 = $sth->fetchAll();

	$str = "[\n";
	foreach($result1 as $line){
		$str .= "{
       				name: \"" . $line['name'] . "\",
       				lat: " . $line['lat'] . ",
        			lng: " . $line['lng'] . ",
 			},";
	}
	$str .= "]";
	
	//アイテムの情報取得
	$sth = $dbh->prepare('SELECT * FROM spot_items WHERE id=?;');
        $sth->execute(array(htmlspecialchars($_POST['id'])));
        $result2 = $sth->fetch();
?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/item_detail.css">
<script>
	var markerData = <?php echo $str ?>;
</script>
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
			<?php echo $add_list; ?>
                        <?php echo $login_list; ?>
		</nav>
	</div>
	<div class="col-md-10">
		<div class="row">
			<div class="col-md-12">
				<h2>アイテムの詳細</h2>

				<div id="content">
					<div class="row">
                                                <p class="col-md-4">アイテムの作成者：</p>
                                                <p class="col-md-8  description"><?php echo $result2['author']; ?></p>
                                            </div>
					<div class="row">
					    	<p class="col-md-4">アイテムの名前：</p>
					    	<p class="col-md-8  description"><?php echo $result2['name']; ?></p>
					    </div>
					    
					    <div class="row">
					    	<p class="col-md-4">アイテムの説明：</p>
					    	<p class="col-md-8  description"><?php echo $result2['body']; ?></p>
					    </div>
					<div id="map" style="width:450px; height:320px;"></div>

	<?php
        	for($i = 0; $i < count($result1); $i++){

        		$n = $i + 1;
			$str_n = mb_convert_kana((string) $n, "N");
			print("<div class=\"spot\" id=\"spot_" . $n . "\">
                                            <h3>". $str_n ."つ目</h3>
                                            <div class=\"row\">
                                                <p class=\"col-md-4\">おすすめスポットの名前：</p>
                                                <p class=\"col-md-8  description\">" . $result1[$i]['name'] ."</p>
                                            </div>
                                            <div class=\"row\">
                                                <p class=\"col-md-4\">おすすめスポットの説明：</p>
                                                <p class=\"col-md-8  description\">" . $result1[$i]['body'] . "</p>
                                            </div>
                                            <input type=\"button\" value=\"地図を表示\" class=\"btn btn-outline-info\" onclick=\"map_id_set(" . $n . ");\">");
			if($i == 0){
				print("<div id=\"map_detail\" style=\"width:450px; height:320px;\"></div>");
			}
			
			print("</div>");
		}
	?>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="js/display_map.js"></script>
<script async defe
	src="https://maps.googleapis.com/maps/api/js?key=<APIキー>&callback=initMap">
</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>



