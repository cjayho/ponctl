<div align="center">
<h1>
Добавить OLT
</h1>
<br/>
<form method="post" action="addolt_sql.php">
IP адрес: <input required name="olt" size="13" type="text" id="olt" placeholder="OLT"><br/>
SNMP ro: <input name="ro" size="13" type="text" id="ro" placeholder="Read Community"><br/>
SNMP rw: <input name="rw" size="13" type="text" id="rw" placeholder="Write Community"><br/>
Место: <input name="place" size="13" type="text" id="place" placeholder="Место установки"><br/>
Количество PON SFP <input required name="numsfp" size="13" type="text" id="numsfp" value="4"><br/>
<br/>
<input name="add" type="submit" id="add" value="ADD OLT" style="width:80px">
</form>
</div>
