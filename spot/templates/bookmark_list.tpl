<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/user_detail.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
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
<div class="row" id="container">
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
                                <h2 class="col-md-12" id="user_info">お気に入り一覧</h2>
                        </div>
		{foreach from=$spots item=item}
                                <div class="item">
                                        <a href="item_detail.php?id={$item['id']}" title="" >
                                                <h3>{$item['name']}</h3>
                                                <p class="item_body">{$item['body']}</p>
                                                <p class="author">作成者　{$item['author']}</p>
                                        </a>
                                </div>
                 {/foreach}

        </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>

