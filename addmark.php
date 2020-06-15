<?php

$olt_mark = str_replace('.','_',$olt);
$mac_mark = str_replace(':','_',$mac);

$mark = $olt_mark.$mac_mark;

if ($twirl_color == NULL) {
$twirl_color = "black";
}


 ?>





var myPlacemark<?php echo $mark; ?> = new ym.Placemark(
                        // Координаты метки
                        [<?php echo "$lat, $lon"?>], {
                        iconContent:'<font size="2"><?php echo $nameint; ?></font>',
                        balloonContent: '<font size="3" color="#6B002B"><br/><b><?php echo $nameint; ?></b><br/><?php echo $comments; ?><br/><?php echo $pwr; ?><br/><?php echo $mac; ?><br/><a href="index.php?page=onu&olt=<?php echo $olt; ?>&iface=<?php echo $iface; ?>">Карточка ONU</a></font>'
}, {
                        preset: 'twirl#<?php echo $twirl_color; ?>StretchyIcon'

});



                // Добавление метки на карту
                map.geoObjects.add(myPlacemark<?php echo $mark; ?>);
