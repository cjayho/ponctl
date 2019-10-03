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
$sfp = $_GET["sfp"];
$table = $olt;
$ip = str_replace ("_", ".", $table);
include 'vars.php';
?>

<!-- Подключаем API  карт 2.x  -->
<script src="http://api-maps.yandex.ru/2.0.7/?load=package.full&lang=ru-RU"></script>
<script type="text/javascript">
        // Как только будет загружен API и готов DOM, выполняем инициализацию
ymaps.ready(init);

function init () {
    var map = new ymaps.Map('map', {
            center: [<?php echo $default_lat; ?>,<?php echo $default_lon; ?>],
            zoom: 11,
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
include 'layers.php';
echo "map.layers.add($layer);";
//include 'layers.php';
}

?>



map.behaviors.enable('scrollZoom');

    map.controls
        // Кнопка изменения масштаба.
        .add('zoomControl', { left: 5, top: 5 })
        // Список типов карты
        .add('typeSelector')
        // Стандартный набор кнопок
        .add('mapTools', { left: 35, top: 5 });

<?php include 'multiple_onu_on_map.php'; ?>
}
    </script>

</head>
<body>
<div align="center">
Карта ONU на <?php echo $ip; ?>
<br/>
<br/>
<div align="right">
<?php
include 'set_sfp.php';
?>
</div>
<br/>
<div id="map" style="width:900px; height:500px"></div>
<br/>
</body>
</html>
