var map;
var map_detail;
var marker = [];
var marker_detail;
var infoWindow = [];
//var markerDataは読み込むhtmlの中に記述してあります


function initMap() {
 // 地図の作成
    var mapLatLng = new google.maps.LatLng({lat: markerData[0]['lat'], lng: markerData[0]['lng']}); // 緯度経度のデータ作成
   map = new google.maps.Map(document.getElementById('map'), { // #sampleに地図を埋め込む
     center: mapLatLng, // 地図の中心を指定
      zoom: 1 // 地図のズームを指定
   });

//地図のズーム調整
    var lat = markerData.map(function (p) {
        return p.lat;
    });
    var lng = markerData.map(function (p) {
        return p.lng;
    });

    var maxlat = Math.max.apply(null, lat);//最大緯度
    var maxlng = Math.max.apply(null, lng);//最大経度
    var minlat = Math.min.apply(null, lat);//最小緯度
    var minlng = Math.min.apply(null, lng);//最小経度
    //北西端の座標を設定
    var sw = new google.maps.LatLng(maxlat,minlng);
    //東南端の座標を設定
    var ne = new google.maps.LatLng(minlat,maxlng);
     
    //範囲を設定
    var bounds = new google.maps.LatLngBounds(sw, ne);
     
    //自動調整
    map.fitBounds(bounds,5);

 
 // マーカー毎の処理
 for (var i = 0; i < markerData.length; i++) {
        markerLatLng = new google.maps.LatLng({lat: markerData[i]['lat'], lng: markerData[i]['lng']}); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({ // マーカーの追加
         position: markerLatLng, // マーカーを立てる位置を指定
            map: map // マーカーを立てる地図を指定
       });
 
     infoWindow[i] = new google.maps.InfoWindow({ // 吹き出しの追加
         content: '<div class="sample">' + markerData[i]['name'] + '</div>' // 吹き出しに表示する内容
       });
 
     markerEvent(i); // マーカーにクリックイベントを追加
 }
 
}
 
// マーカーにクリックイベントを追加
function markerEvent(i) {
    marker[i].addListener('click', function() { // マーカーをクリックしたとき
        for(var j = 0; j < marker.length; j++){
            infoWindow[j].close();
      }
      infoWindow[i].open(map, marker[i]); 
      
      // 吹き出しの表示
  });




//詳細のマップを作成
    // 地図の作成
    var mapLatLng = new google.maps.LatLng({lat: markerData[0]['lat'], lng: markerData[0]['lng']}); // 緯度経度のデータ作成
   map_detail = new google.maps.Map(document.getElementById('map_detail'), { // #sampleに地図を埋め込む
     center: mapLatLng, // 地図の中心を指定
      zoom: 15 // 地図のズームを指定
   });

   marker_detail = new google.maps.Marker({ // マーカーの追加
        position: mapLatLng, // マーカーを立てる位置を指定
      map: map_detail // マーカーを立てる地図を指定
   });
}


function map_id_set(n){
    var map_pos = "#spot" + "_" + n;
    $('#map_detail').insertAfter(map_pos);
    marker_detail.setMap(null);
    var mapLatLng = new google.maps.LatLng({lat: markerData[n-1]['lat'], lng: markerData[n-1]['lng']});
    marker_detail = new google.maps.Marker({ // マーカーの追加
        position: mapLatLng, // マーカーを立てる位置を指定
      map: map_detail 
    });
    map_detail.setCenter(mapLatLng);


}

