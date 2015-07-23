<?php
$country=intval($_GET['country']);
require("dbinfo.php");
// Opens a connection to a MySQL server
$connection=mysql_connect ($servername, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}
// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
// Query to populate country list
$query="SELECT id,statename FROM state WHERE countryid='$country' ORDER BY statename";
$result=mysql_query($query);
?>
<select name="state" onchange="getCity(<?=$country?>,this.value)">
<option>Select State</option>
<?php 
while($row=mysql_fetch_array($result)) {
echo '<option value="'.$row['id'].'">'.$row['statename'].'</option>';
}
?>
</select>
