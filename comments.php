<font size="2">
<?php
$ip = str_replace ("_", ".", $ip);
$ip_sql = sprintf('%u', ip2long($ip));
?>
<form method="post" action="set_comments.php?olt=<?php echo $ip; ?>&mac=<?php echo $mac; ?>">
<input required name="comments" size="25" type="text" id="comments" value="<?php echo $comments; ?>">
&nbsp;<input name="add" type="submit" id="add" value="OK" style="width:50px;">
<br/>
<br/>
<button name="del" type="button" id="del" style="width:140px;"   onclick="window.location='reset_comments.php?olt=<?php echo $ip; ?>&mac=<?php echo $mac; ?>';" />Удалить описание</button>

</form>
</font>
