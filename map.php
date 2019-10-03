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
?>

<script type='text/javascript'>//<![CDATA[
window.onload=function(){
ym.ready(function() {
    var map = new ym.Map('map', {
        center: [<?php echo "$lat, $lon"?>],
        zoom: 14,
<?php
if ($layer == "yandexLayer") {
} else {
?>
        type: null // что-бы не загружался слой "Схема" Яндекс.Карт
<?php
}
?>
    }, {});

<?php
if ($layer == "yandexLayer") {
} else {
?>
    var heresatLayer = new ym.Layer('http://1.aerial.maps.cit.api.here.com/maptile/2.1/maptile/newest/hybrid.day/%z/%x/%y/256/png8?app_id=DemoAppId01082013GAL&app_code=AJKnXv84fjrb0KIHawS0Tg', {
        projection: ym.projection.sphericalMercator,
        // указываем проекцию слоя OSM
        tileTransparent: true
    });


 var heremapLayer = new ym.Layer('http://1.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/normal.day/%z/%x/%y/256/png8?app_id=DemoAppId01082013GAL&app_code=AJKnXv84fjrb0KIHawS0Tg', {
        projection: ym.projection.sphericalMercator,
        // указываем проекцию слоя OSM
        tileTransparent: true
    });



    var osmLayer = new ym.Layer('http://otile%d.mqcdn.com/tiles/1.0.0/osm/%z/%x/%y.png', {
        projection: ym.projection.sphericalMercator,
        // указываем проекцию слоя OSM
        tileTransparent: true
    });

    map.layers.add(<?php echo $layer; ?>);
<?php
}

include 'addmark.php';
?>





map.behaviors.enable('scrollZoom');


    map.controls
        // Кнопка изменения масштаба.
        .add('zoomControl', { left: 5, top: 5 })
        // Список типов карты
        .add('typeSelector')
        // Стандартный набор кнопок
        .add('mapTools', { left: 35, top: 5 });






})
}//]]>

</script>

<script src="http://api-maps.yandex.ru/2.0.7/?ns=ym&load=package.full&lang=ru-RU"></script>



