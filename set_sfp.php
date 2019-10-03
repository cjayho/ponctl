<div id="set_sfp">
<?php
$count_sfp = 1;
?>
<select style="padding-right:5px;" name="forma" onchange="location = this.options[this.selectedIndex].value;">
<?php
echo "<option value=\"index.php?page=olt&olt=$ip\">SFP #</option>";
echo "<option value=\"index.php?page=olt&olt=$ip\">ALL</option>";
while ($count_sfp <= $numsfp) {

echo "<option value=\"index.php?page=olt&olt=$ip&sfp=$count_sfp\">SFP $count_sfp</option>";

$count_sfp = $count_sfp + 1;

}
echo "</select>";
?>
</div>
