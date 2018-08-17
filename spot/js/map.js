var marker_ary = new Array();
var overlays = [];
var geocoder;
var map;
var map_id = ["google_map_lat_1", "google_map_lng_1"];
    function initMap() {
      // The location of Uluru
      var uluru = {lat: 35.710063, lng: 139.8107};
      // The map, centered at Uluru
      map = new google.maps.Map(
          document.getElementById('map'), {zoom: 16, center: uluru});
      // The marker, positioned at Uluru
      var marker = new google.maps.Marker({position: uluru, map: map});


      // ジオコードオブジェクト
      geocoder = new google.maps.Geocoder(); 
      // 地図上クリックで mylistenerへ
      //google.maps.event.addListener(map, 'click', mylistener);
      map.addListener('click', function(e) {
        mylistener(e.latLng, map);
      });

      $("#btn").bind("click",function(){
                codeAddress();
            }).trigger("click");

    }

    function mylistener(latLng, map) {
    MarkerClear();
    document.getElementById("address").value = "";
 
    // lat(緯度)・lng(経度)を表示（IDがgoogle_map_latとgoogle_map_lngの箇所に）
    document.getElementById(map_id[0]).value = latLng.lat();
    document.getElementById(map_id[1]).value = latLng.lng();
 
    // codeAddress_onclick へ値を渡す
    codeAddress_onclick(latLng.toUrlValue());
    }

    function MarkerClear() {
        //マーカー削除
        for (i = 0; i <  marker_ary.length; i++) {
            marker_ary[i].setMap(null);
        }
 
        //配列削除
        for (i = 0; i <=  marker_ary.length; i++) {
            marker_ary.shift();
        }
 
        //IDがgoogle_map_lat、google_map_lng の箇所の文字、IDがaddressの内容を空に
    document.getElementById(map_id[0]).value = "";
    document.getElementById(map_id[1]).value = "";
 
    }

    function codeAddress_onclick(clatlng) {
        var clatlngarr = clatlng.split(",");
        var clat = clatlngarr[0];
        var clng = clatlngarr[1];
 
        // オーバーレイ消去
        if(overlays.length>0){
        // for(i in overlays){  //この書き方はprototype.js に汚染せれるため次行に書換。
        for(var i=0; i < overlays.length; i++ ){
            overlays[i].setMap(null);
        }
            overlays.length=0;
        }
        // 地図の中心点を変更（クリックした場所をセンターにすると不便なので不採用）
        // map.setCenter(new google.maps.LatLng(clat,clng));
 
        // マーカー
        var Markerlatlng;
        var marker_num = marker_ary.length;
        marker_ary[marker_num] = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(clat,clng)
        });
        
    } // end of codeAddress_onclick
 
 function codeAddress() {
            // 地図クリックで表示されていたマーカーと情報ウィンドウを削除
            MarkerClear();
 
            var address = document.getElementById('address').value;
             
            // geocode (住所から緯度経度を取得)
            geocoder.geocode( { 'address': address, 'language': 'ja'}, function(results, status) {
                if(status==google.maps.GeocoderStatus.OK){
                    // オーバーレイ消去
                    if(overlays.length>0){
                        // for(i in overlays){  //この書き方はprototype.js に汚染せれるため次行に書換。
                        for(var i=0; i < overlays.length; i++ ){
                            overlays[i].setMap(null);
                        }
                        overlays.length=0;
                    }
 
                    // 地図の中心点を変更
                    map.setCenter(results[0].geometry.location);
 
                    // 指定された境界に合うように地図を表示
                    if(results[0].geometry.bounds)map.fitBounds(results[0].geometry.bounds);
                    if(results[0].geometry.viewport)map.fitBounds(results[0].geometry.viewport);
 
                    // マーカー
                    var marker = new google.maps.Marker({
                        map:map,
                        position: results[0].geometry.location
                    });
 
                    var latLngArr = results[0].geometry.location.toUrlValue();
                    var Arrayltlg = latLngArr.split(",");
                    document.getElementById(map_id[0]).value = Arrayltlg[0];
                    document.getElementById(map_id[1]).value = Arrayltlg[1];
 
                }else{
                    alert("ジオコードの取得に失敗しました\n"+status);
                }
            });
            return false;
        }

function map_id_set(n){
    var str_lat = "google_map_lat";
    var str_lng = "google_map_lng";
    var map_pos = "#spot" + "_" + n;

    map_id[0] = str_lat + "_" + n;
    map_id[1] = str_lng + "_" + n;

    $('#wrap_map').insertAfter(map_pos);

}

