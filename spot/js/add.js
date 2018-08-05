var total_count = 3;
function spot_add(){
    if(total_count <= 10){
        total_count++;
        var spot_id = "#spot_" + total_count;
        $('#spot_append').before('<div class="spot" id="spot_' + total_count + '">');
        $(spot_id).append('<h3>' + total_count + 'つ目</h3>');
        $(spot_id).append('<label>おすすめスポットの名前：<input type="text" name="spot_name_' + total_count +'" id="name" value="<?php echo $spot[' + total_count-1  +']["name"]; ?>"></label><br>');
        $(spot_id).append('<label>おすすめスポットの説明：<textarea name=" spot_body_' + total_count + '" id="" cols="30" rows="3"></textarea></label><br>');
        $(spot_id).append('<label>おすすめスポットの緯度：<input type="text" name="spot_lat_' + total_count  +'" id="google_map_lat_' + total_count + '" value=""></label><br>');
        $(spot_id).append('<label>おすすめスポットの経度：<input type="text" name="spot_lng_' + total_count  + '" id="google_map_lng_' + total_count + '" value=""></label><br>');
        $(spot_id).append('<input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(' + total_count + ');">');
    }

    if(total_count >= 10){
        $('#spot_append').remove();
    }
    
 	document.getElementById("count").value = total_count;   
}
