<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/item_detail.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script>
	var markerData = {$str};
</script>
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
				<h2>アイテムの詳細</h2>

				<div id="content">
					<div class="row">
                                                <p class="col-md-4">アイテムの作成者：</p>
                                                	<a href="user_detail.php?user={$result2['author']}" class="col-md-8  description">{$result2['author']}</a>
					</div>
					<div class="row">
					    	<p class="col-md-4">アイテムの名前：</p>
					    	<p class="col-md-8  description">{$result2['name']} {$bookmark_text}</p>
					    </div>
					    
					    <div class="row">
					    	<p class="col-md-4">アイテムの説明：</p>
					    	<p class="col-md-8  description">{$result2['body']}</p>
					    </div>
					<div id="map" style="width:450px; height:320px;"></div>
	
		{section name=i start=0 loop=$result1}
			<div class="spot" id="spot_{$smarty.section.i.index}">
                                            <div class="row">
                                                <p class="col-md-4">おすすめスポットの名前：</p>
                                                <p class="col-md-8  description">{$result1[$smarty.section.i.index]['name']}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-md-4">おすすめスポットの説明：</p>
                                                <p class="col-md-8  description">{$result1[$smarty.section.i.index]['body']}</p>
                                            </div>
                                            <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set({$smarty.section.i.index});">
			{if $smarty.section.i.index == 0}
				<div id="map_detail" style="width:450px; height:320px;"></div>
			{/if}
			
			</div>
		
		{/section}
			</div>
		</div>
	</div>
</div>

{literal}
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
                        'user':"{/literal}{$login_name}{literal}",
                        'item_id':"{/literal}{$id}{literal}",
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
{/literal}
<script type="text/javascript" src="../js/display_map.js"></script>
<script async defe
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSEHZrMXeXRx-z0heZfwOpt4A31YtSgZE&callback=initMap">
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>

