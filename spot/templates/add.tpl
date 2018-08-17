<!DOCTYPE>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/add.css">
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
				<h2>スポットを登録</h2>
				<form action="" method="post">
					{$error_message}
					<label>アイテムの名前：<input type="text" name="item_name" id="name" value="{$item['name']}"></label><br>
				    <label>アイテムの説明：<textarea name="item_body" id="" cols="30" rows="3">{$item['body']}</textarea><br /></label>
				    <div class="spot" id="spot_1">
					    <h3>１つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_1" id="name" value="{$spot[0]['name']}"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_1" id="" cols="30" rows="3">{$spot[0]['body']}</textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_1" id="google_map_lat_1" value="{$spot[0]['lat']}"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_1" id="google_map_lng_1" value="{$spot[0]['lng']}"></label><br>
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(1);">
				    </div>
				    <div id="wrap_map">
				        <input type="text" id="address" value="東京スカイツリー">
				        <input type="button" id="btn" value="検索" class="btn btn-secondary">
						<div id="map" style="width:635px; height:400px;">
						</div>
				    </div>
				    <div class="spot" id="spot_2">
				    	<h3>２つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_2" id="name" value="{$spot[1]['name']}"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_2" id="" cols="30" rows="3">{$spot[1]['body']}</textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_2" id="google_map_lat_2" value="{$spot[1]['lat']}"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_2" id="google_map_lng_2" value="{$spot[1]['lng']}"></label><br>
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(2);">
					</div>
					<div class="spot" id="spot_3">
				    	<h3>3つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_3" id="name" value="{$spot[2]['name']}"></label><br>
					    <label>おすすめスポットの説明：<textarea name="spot_body_3" id="" cols="30" rows="3">{$spot[2]['body']}</textarea></label><br>
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_3" id="google_map_lat_3" value="{$spot[2]['lat']}"></label><br>
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_3" id="google_map_lng_3" value="{$spot[2]['lng']}"></label><br>
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(3);">
					</div>
				    
				    <label id="spot_append"><input type="button" value="スポットを追加" class="btn btn-outline-warning" onclick="spot_add();">      ※１０個まで追加できます</label><br>
					<input type="hidden" value="3" id="count" name="count">
				    <input type="submit" value="スポットを登録" name="add" class="float-right btn btn-success">
					<input type="hidden" name="token" value="{$csrf_token}">
					<input type="hidden" name="spot_hidden_4" id="spot_hidden_4" value="{if $total_count >= 4} {$spot[3]['name']} , {$spot[3]['body']} , {$spot[3]['lat']} , {$spot[3]['lng']}{/if}">
					<input type="hidden" name="spot_hidden_5" id="spot_hidden_5" value="{if $total_count >= 5} {$spot[4]['name']} , {$spot[4]['body']} , {$spot[4]['lat']} , {$spot[4]['lng']}{/if}">
					<input type="hidden" name="spot_hidden_6" id="spot_hidden_6" value="{if $total_count >= 6} {$spot[5]['name']} , {$spot[5]['body']} , {$spot[5]['lat']} , {$spot[5]['lng']}{/if}">
					<input type="hidden" name="spot_hidden_7" id="spot_hidden_7" value="{if $total_count >= 7} {$spot[6]['name']} , {$spot[6]['body']} , {$spot[6]['lat']} , {$spot[6]['lng']}{/if}">
					<input type="hidden" name="spot_hidden_8" id="spot_hidden_8" value="{if $total_count >= 8} {$spot[7]['name']} , {$spot[7]['body']} , {$spot[7]['lat']} , {$spot[7]['lng']}{/if}">
					<input type="hidden" name="spot_hidden_9" id="spot_hidden_9" value="{if $total_count >= 9} {$spot[8]['name']} , {$spot[8]['body']} , {$spot[8]['lat']} , {$spot[8]['lng']}{/if}">
					<input type="hidden" name="spot_hidden_10" id="spot_hidden_10" value="{if $total_count >= 10} {$spot[9]['name']} , {$spot[9]['body']} , {$spot[9]['lat']},{$spot[9]['lng']}{/if}">
				</form>
			</div>
		</div>
		
	</div>
</div>

{literal}
<script>
var total_count = 3;
function spot_add(){

    if(total_count <= 10){
        total_count++;
        var spot_id = "#spot_" + total_count;
        $('#spot_append').before('<div class="spot" id="spot_' + total_count + '">');
        $(spot_id).append('<h3>' + total_count + 'つ目</h3>');
        $(spot_id).append('<label>おすすめスポットの名前：<input type="text" name="spot_name_' + total_count +'" id="spot_name_' + total_count +'"></label><br>');
        $(spot_id).append('<label>おすすめスポットの説明：<textarea name=" spot_body_' + total_count + '" id="spot_body_' + total_count + '" cols="30" rows="3"></textarea></label><br>');
        $(spot_id).append('<label>おすすめスポットの緯度：<input type="text" name="spot_lat_' + total_count  +'" id="google_map_lat_' + total_count + '" value=""></label><br>');
        $(spot_id).append('<label>おすすめスポットの経度：<input type="text" name="spot_lng_' + total_count  + '" id="google_map_lng_' + total_count + '" value=""></label><br>');
        $(spot_id).append('<input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(' + total_count + ');">');
    }
	if(total_count == 4){
		 $('#spot_append').after('<label id="spot_del" class="col-md-12"><input type="button" value="スポットを削除" class="btn btn-outline-secondary" id="del_btn" onclick="spot_del();"></label>');
	}

    if(total_count >= 10){
        $('#spot_append').remove();
    }
	document.getElementById("count").value = total_count;
}

function spot_del(){
	var spot_id = "#spot_" + total_count;
	$(spot_id).remove();
	total_count--;
	if(total_count == 3){
                $('#del_btn').remove();
        }

	if(total_count == 9){
		$('#spot_del').before('<label id="spot_append"><input type="button" value="スポットを追加" class="btn btn-outline-warning" onclick="spot_add();">      ※１０個まで追加できます</label><br>');
	}

	document.getElementById("count").value = total_count;
}

{/literal}

{$script}

{literal}

if(total_count >= 4){
	for(var i = 4; i <= total_count; i++){
		var spot_hidden = 'spot_hidden_' + i;
		var spot_name = 'spot_name_' + i;
		var spot_body = 'spot_body_' + i;
		var google_map_lat = 'google_map_lat_' + i;
		var google_map_lng = 'google_map_lng_' + i;
		
        	var spot_hidden = document.getElementById('spot_hidden_' + i).value;
        	spot_hidden = spot_hidden.split(',');
        	document.getElementById('spot_name_' + i).value = spot_hidden[0];
        	document.getElementById('spot_body_' + i).value = spot_hidden[1];
		if(!isNaN(parseFloat(spot_hidden[2]))){
			document.getElementById('google_map_lat_' + i).value = parseFloat(spot_hidden[2]);
		}
		if(!isNaN(parseFloat(spot_hidden[3]))){
                        document.getElementById('google_map_lng_' + i).value = parseFloat(spot_hidden[3]);
                }
	
	}

}

</script>
{/literal}
<script type="text/javascript" src="../js/map.js"></script>				    
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSEHZrMXeXRx-z0heZfwOpt4A31YtSgZE&callback=initMap">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>

