<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Daum 지도 시작하기</title>
</head>
<body>
	<?php
		echo "<h1>testing</h1>"
	?>
	<div id="map" style="width:800px;height:600px;"></div>
	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=19e3041c91b06a8d81b09ea22d8d8424&libraries=services"></script>
	<script>
		var container = document.getElementById('map');
		var options = {
			center: new daum.maps.LatLng(36.6043007,127.2963321),
			level: 3
		};

		var map = new daum.maps.Map(container, options);

		var mapTypeControl = new daum.maps.MapTypeControl();
		map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);
		var zoomControl = new daum.maps.ZoomControl();
        map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);

        var positions = [
            {
                content: '<div>샛별어린이집</div>',
                addr: '세종특별자치시 조치원읍 교리 21-5'
            },
            {
                content: '<div>주공수퍼</div>',
                addr: '세종특별자치시 조치원읍 군청로 117'
            },
            {
                content: '<div>돌쇠파닭</div>',
                addr: '세종특별자치시 조치원읍 군청로 23'
            },
            {
                content: '<div>세종시장애인자립생활센터</div>',
                addr: '세종특별자치시 조치원읍 군청로 24'
            }
        ];

        var imageSrc = "http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";
        var imageSize = new daum.maps.Size(24, 35);
        var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize);
        var geocoder = new daum.maps.services.Geocoder();
        var idx = 0;
        for (var i = 0; i < positions.length; i++) {
            geocoder.addressSearch(positions[i].addr, function(result, status) {
                if (status === daum.maps.services.Status.OK) {
                    var coords = new daum.maps.LatLng(result[0].y, result[0].x);
                    var marker = new daum.maps.Marker({
                        map: map,
                        position: coords,
                        image: markerImage
                    });
                    var infowindow = new daum.maps.InfoWindow({
                    	content: positions[idx].content
                    });
                    daum.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
    				daum.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
                }
                idx++;
            });
        }

        function makeOverListener(map, marker, infowindow) {
			return function() {
				infowindow.open(map, marker);
			};
		}
		function makeOutListener(infowindow) {
			return function() {
				infowindow.close();
			};
		}

	</script>
</body>
</html>
