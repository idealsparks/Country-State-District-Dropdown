<?php
$countryId=intval($_GET['country']);
$stateId=intval($_GET['state']);
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
// Query to populate district list
$query="SELECT id,district FROM district WHERE countryid='$countryId' AND stateid='$stateId' ORDER BY district";
$result=mysql_query($query);
?>
<select name="district">
<option>Select District</option>
<?php
while($row=mysql_fetch_array($result)) {
echo '<option value="'.$row['id'].'">'.$row['district'].'</option>';
}
?>
</select>
