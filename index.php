<!------------------------------------
**************************************


Work in Progress
Developed by Shahed Jamal
Contact: sjr.mdpur@gmail.com
Github: https://github.com/shahed-jamal


**************************************   
------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Country, State, District Ajax drop-down code</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getState(countryId) {		
		
		var strURL="findState.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getCity(countryId,stateId) {		
		var strURL="findDistrict.php?country="+countryId+"&state="+stateId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('distdiv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>
</head>
<body>
<form method="post" action="" name="form1">
<table width="30%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="150">Country</td>
    <td  width="150">
		<?php
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
		$query="SELECT id,country FROM country WHERE 1";
		$result=mysql_query($query);
		?>
		<select name="country" onChange="getState(this.value)">
		<option>Select Country</option>
		<?php while($row=mysql_fetch_array($result)) {
		echo '<option value="'.$row['id'].'">'.$row['country'].'</option>';
		}
		?>
		</select>
	</td>	
  </tr>
  <tr>
    <td>State</td>
    <td>
	<div id="statediv">
	<select name="state" >
		<option>Select Country First</option>
    </select>
	</div>
	</td>
  </tr>
  <tr>
    <td>District</td>
    <td>
	<div id="distdiv">
	<select name="district">
		<option>Select State First</option>
    </select>
	</div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
