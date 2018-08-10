<?php
        require_once('init.php');
        $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');

	$login_status = "";
	$login_name;
	$login_status_text;
	$list_text = "";
	$login_list;
	$bookmark_is;
	$bookmark_text = "";
	

	$login_status = login_check();
	//ログインチェック
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
	
	
	$id = (int)htmlspecialchars($_GET['id']);
	//ユーザがお気に入り済かのチェック
        $sth = $dbh->prepare('SELECT COUNT(*) FROM bookmark WHERE user = ? && item_id = ? ;');
        $sth->execute(array($login_name, $id));
        $result = $sth->fetch();
        //お気に入り済の場合true
        if($result[0] != '0'){
                $bookmark_is = true;
        }else{
                $bookmark_is = false;
        }
        $bookmark_is_text = "";
        if($bookmark_is){
                $bookmark_is_text = "お気に入り済";
        }else{
                $bookmark_is_text = "お気に入り";
        }
        //お気に入りボタンの表示
        if($login_status == true){
                $bookmark_text = "<input type=\"button\" class=\"btn btn-outline-success\" id=\"bookmark_btn\" value=\"" . $bookmark_is_text . "\">";
        }


	$str = "";

        $sth = $dbh->prepare('SELECT * FROM items_detail WHERE item_id = :id;');
	$sth->bindParam(':id', $id);

	//$id = (int)htmlspecialchars($_GET['id']); すでに受け取ってるためコメントアウト
        $sth->execute();
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
	$sql = 'SELECT * FROM spot_items WHERE id= ' . $id . ';';
	$sth = $dbh->prepare('SELECT * FROM spot_items WHERE id= :id;');
	$sth->bindParam(':id', $id);
        $sth->execute();
	$result2 = $sth->fetch();
?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/item_detail.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
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
			<p id="login_status"><?php echo $login_status_text; ?></p>
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
				<h2>アイテムの詳細</h2>

				<div id="content">
					<div class="row">
                                                <p class="col-md-4">アイテムの作成者：</p>
                                                	<a href="user_detail.php?user=<?php echo $result2['author']; ?>" class="col-md-8  description"><?php echo $result2['author']; ?></a>
					</div>
					<div class="row">
					    	<p class="col-md-4">アイテムの名前：</p>
					    	<p class="col-md-8  description"><?php echo $result2['name']; echo $bookmark_text;?></p>
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

<script>
$(function(){
            // Ajax button click
            $('#bookmark_btn').on('click',function(){
                var bookmark_is;
                if(this.value == "お気に入り"){
                      this.value = "お気に入り済"
                      bookmark_is = true;
                }else{
                      this.value = "お気に入り"
                      bookmark_is = false;
                }

                $.ajax({
                    url:'./bookmark.php',
                    type:'POST',
                    data:{
                        'user':"<?php echo $login_name ?>",
                        'item_id':"<?php echo $id ?>",
                        'bookmark_is':bookmark_is
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
<script type="text/javascript" src="js/display_map.js"></script>
<script async defe
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSEHZrMXeXRx-z0heZfwOpt4A31YtSgZE&callback=initMap">
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>



