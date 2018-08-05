<?php
        require_once('init.php');

        if(isset($_SESSION['username'])){
                $login_status = $_SESSION["username"] . "でログイン中";
                $login_list = "<a class=\"nav-link\" href=\"user_logout.php\">ログアウト</a>";
                $add_list = "<a class=\"nav-link\" href=\"add.php\">スポット登録</a>";
        }else{
                $login_status = "未ログイン";
                $login_list = "<a class=\"nav-link\" href=\"user_login.php\">ログイン</a>";
        }
?>

<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/common.css">
<style>
        #logout{
                margin-top: 20px;
	}
</style>
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
                        <div class="col-md-10">
                                <div class="alert alert-success" role="alert" id="logout">
                                        <strong>スポットを登録しました。</strong>
                                </div>
                        </div>
                </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
