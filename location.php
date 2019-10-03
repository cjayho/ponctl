<?php


$maptype = $_GET["maptype"];
if ($maptype == "heremap") {
$layer = "heremapLayer";
} else if ($maptype == "heresat") {
$layer = "heresatLayer";
} else if ($maptype == "osm") {
$layer = "osmLayer";
} else {
$layer = "yandexLayer";
}
$olt = $_GET["olt"];
$mac = $_GET["mac"];
$table=$olt;
include 'vars.php';
include 'iface_by_mac.php';

if ($use_userside == "yes") {
include 'get_code_by_id.php';
if ($code == NULL) {
include 'get_comments_by_id.php';
} else {
include 'get_us_data.php';
include 'make_comments_by_us.php';
}
} else {
include 'get_comments_by_id.php';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Инструмент для определения координат - API Яндекс.Карт 2.0</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://api-maps.yandex.ru/2.0.7/?load=package.full&lang=ru-RU"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link href="/examples/add-users-ymapsapi2/css/bootstrap.min.css" rel="stylesheet" />

    <style>
      #YMapsID {
        margin: 0;
        padding: 0;
	height: 500px;
	width: 100%;
	text-align: center;
      }
    </style>
    <script type="text/javascript">
        var myMap, myPlacemark, coords;
        ymaps.ready(init);
        function init () {

                //Определяем начальные параметры карты
            myMap = new ymaps.Map('YMapsID', {
                    center: [<?php echo $default_lat; ?>,<?php echo $default_lon; ?>],
                    zoom: 10,
<?php
if ($layer == "yandexLayer") {
?>
type: 'yandex#hybrid'
<?php
} else {
?>
        type: null // что-бы не загружался слой "Схема" Яндекс.Карт
<?php
}
?> 
                });




<?php
if ($layer == "yandexLayer") {
} else {
?>

var heresatLayer = new ymaps.Layer('http://1.aerial.maps.cit.api.here.com/maptile/2.1/maptile/newest/hybrid.day/%z/%x/%y/256/png8?app_id=DemoAppId01082013GAL&app_code=AJKnXv84fjrb0KIHawS0T$
        projection: ymaps.projection.sphericalMercator,
        // указываем проекцию слоя OSM
        tileTransparent: true
    });


 var heremapLayer = new ymaps.Layer('http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/%z/%x/%y/256/png8?app_id=DemoAppId01082013GAL&app_code=AJKnXv84fjrb0KIHawS0Tg', {
        projection: ymaps.projection.sphericalMercator,
        // указываем проекцию слоя OSM
        tileTransparent: true
    });



    var osmLayer = new ymaps.Layer('http://otile%d.mqcdn.com/tiles/1.0.0/osm/%z/%x/%y.png', {
        projection: ymaps.projection.sphericalMercator,
        // указываем проекцию слоя OSM
        tileTransparent: true
    });

    myMap.layers.add(<?php echo $layer; ?>);





<?php
//include 'layers.php';
}

?>

myMap.behaviors.enable('scrollZoom');
                         myMap.controls
                .add('zoomControl')
                .add('typeSelector')
                .add('mapTools');
                        coords = [<?php echo $default_lat; ?>,<?php echo $default_lon; ?>];

myPlacemark = new ymaps.Placemark([<?php echo $default_lat; ?>,<?php echo $default_lon; ?>],{}, {preset: "twirl#redIcon", draggable: true});
                        myMap.geoObjects.add(myPlacemark);

                        //Отслеживаем событие перемещения метки
                        myPlacemark.events.add("dragend", function (e) {
                        coords = this.geometry.getCoordinates();
                        savecoordinats();
                        }, myPlacemark);

                        //Отслеживаем событие щелчка по карте
                        myMap.events.add('click', function (e) {
            coords = e.get('coordPosition');
                        savecoordinats();
                        });

        //Отслеживаем событие выбора результата поиска

        SearchControl.events.add("resultselect", function (e) {

                coords = SearchControl.getResultsArray()[0].geometry.getCoordinates();

                savecoordinats();

        });



        //Ослеживаем событие изменения области просмотра карты - масштаб и центр карты

        myMap.events.add('boundschange', function (event) {

    if (event.get('newZoom') != event.get('oldZoom')) {

        savecoordinats();

    }

          if (event.get('newCenter') != event.get('oldCenter')) {

        savecoordinats();

    }



        });



    }



        //Функция для передачи полученных значений в форму

        function savecoordinats (){

                var new_coords = [coords[0].toFixed(4), coords[1].toFixed(4)];

                myPlacemark.getOverlay().getData().geometry.setCoordinates(new_coords);

                document.getElementById("latlongmet").value = new_coords;

                document.getElementById("mapzoom").value = myMap.getZoom();

                var center = myMap.getCenter();

                var new_center = [center[0].toFixed(4), center[1].toFixed(4)];

                document.getElementById("latlongcenter").value = new_center;

        }


    </script>



</head>



<body>
<h2>
<?php
echo "$comments<br/>";
?>
</h2>
<br/>
<font size="3">
<div align="left">
<?php
echo "<a href=\"index.php?page=onu&olt=$olt&mac=$mac&maptype=$maptype\"><<<Карточка ONU</a>";
?>
</div>
<br/>
<br/>
</font>

<font size="2">
<?php
echo "<a href=\"index.php?page=location&olt=$olt&mac=$mac&maptype=heremap\">Here Map</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href=\"index.php?page=location&olt=$olt&mac=$mac&maptype=heresat\">Here Sat</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href=\"index.php?page=location&olt=$olt&mac=$mac&maptype=osm\">OpenStreet</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href=\"index.php?page=location&olt=$olt&mac=$mac\">Yandex Maps</a>";
?>
</font>
<div align=center>
<div id="YMapsID" align=center style="width:600px; height:400px"></div>
</div>
<div>
<?php
echo "<form method=\"post\" action=\"editlocation_sql.php?olt=$olt&mac=$mac\">";
?>
Координаты: <input id="latlongmet" class="input-medium" name="latlongmet" />
<input name="add" type="submit" id="add" value="Записать">
</div>



</body>
</html>
