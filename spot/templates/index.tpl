<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<!--<link rel="stylesheet" type="text/css" href="index.css">-->
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
		  	<a class="nav-link active" href="">ホーム</a>
			{foreach from=$list_text item=li}
				<a class="nav-link" href="{$li["link"]}">{$li["text"]}</a>
			{/foreach}
			<a class="nav-link" href="{$login_list['link']}">{$login_list['text']}</a>
		</nav>
	</div>
	<div class="col-md-10">
		<div class="row">
			<form action="" method="get" class="col-md-12">
				<div class="input-group" id="serach_bar">
  					<input type="text" class="form-control" name="serach_text" placeholder="" value="{$search_text}">
  					<div class="input-group-append">
    						<input class="btn btn-primary" type="submit" name="serach" value="検索">
  					</div>
				</div>
			</form>
			{foreach from=$result item=item}
				<div class="item">
                                        <a href="item_detail.php?id={$item['id']}" title="" >
                                                <h3>{$item['name']}</h3>
                                                <p class="item_body">{$item['body']}</p>
                                                <p class="author">作成者　{$item['author']}</p>
                                        </a>
                        	</div>
			{/foreach}
		
		<div class="col-md-12" id="page">
			<div class="row">
			<p class="col-md-4">
				{if $page > 1}
      					<a href="?page={($page - 1)}">前のページへ</a>
    				{/if}
			</p>
			<p class="col-md-4">{$page} ページ目</p>
			<p class="col-md-4">
				{if $page < $total_page}
    　　				<a href="?page={($page + 1)}">次のページへ</a>
    				{/if}
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




