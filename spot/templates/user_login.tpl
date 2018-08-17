<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/user_login.css">
</head>

<body>
<div class="row">
        <div class="col-md-12">
                <header>
                        <h1>タイトル</h1>
			<p id="login_status">{$login_status}</p>
                </header><!-- /header -->
        </div>
</div>
<div class="row">
        <div class="col-md-2">
                <nav class="nav flex-column">
                        <a class="nav-link active" href="index.php">ホーム</a>
                	{foreach from=$list_text item=li}
                                <a class="nav-link" href="{$li["link"]}">{$li["text"]}</a>
                        {/foreach}
                        <a class="nav-link" href="{$login_list['link']}">{$login_list['text']}</a>

		</nav>
        </div>
        <div class="col-md-10">
                <div class="row">
                        <div class="col-md-12">
                                <form action="" method="post">
                                        <h2>ユーザーログイン</h2>
                                        {$error_message}
                                        <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">ユーザー名</label>
                                                <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="username"id="name" pattern="^[0-9A-Za-z]+$" placeholder="ユーザー名" value="{$username}">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="password" class="col-sm-2 col-form-label">パスワード</label>
                                                <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="パスワード" value="{$password}">
</div>
                                        </div>
					<div class="float-right">
						<a href="user_sign_up.php" id="sign_in">新規登録</a>
                                        	<input type="submit" class=" float-right btn btn-primary" id="login" name="login" value="ログイン">
					</div>
                                        <input type="hidden" name="token" value="{$csrf_token}">
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

