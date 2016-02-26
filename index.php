
<HTML>
<HEAD>
<TITLE>
ONLINE TEMPERATURE MEASUREMENT SYSTEM
</TITLE>
</HEAD>
<BODY background="g.jpg">
<?php
$connect = mysql_connect("localhost","root","mysql") or die("Couldn't connect to server");
$db = mysql_select_db("sensor",$connect) or die("Couldn't select database");
$sql = "SELECT Time,Temperature1,Humidity1,Temperature2,Humidity2,Pressure FROM sensors order by Time desc limit 20;";
$result = mysql_query($sql) or die("Query failed".mysql_error());
echo "<TABLE border='4' >";
echo "<TR>";
echo "<TH><font color='blue' size='6pt'>Time</font></TH><TH><font color='blue' size='6pt'>Temperature1</font></TH><TH><font color='blue' size='6pt'>Humidity1</font></TH><TH><font color='blue' size='6pt'>Temperature2</font></th><th><font color='blue' size='6pt'>Humidity2</font></th><th><font color='blue' size='6pt'>Pressure</font></th>";

while($row=mysql_fetch_array($result))
{	echo "<tr>";
	echo "<td><b>",
		$row['Time'],"</b></td><td><b>",
		$row['Temperature1'],"</b></td><td><b>",
		$row['Humidity1'],"</b></td><td><b>",
		$row['Temperature2'],"</b></td><td><b>",
		$row['Humidity2'],"</b></td><td><b>",
		$row['Pressure'],"</b></td>";
	echo "</tr>";
}
mysql_close($connect);
echo "</TABLE>";
?>
</BODY>
</HTML>


	
