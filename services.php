<?php include('ConnectLogin.php');
session_start();
if (isset($_SESSION['id']))
{
   if(is_numeric($_SESSION['id']))
   {
      $fid= $_SESSION['id'];
      $id = (int)$fid;
   }
   else{
      $id = $_SESSION['id'];
   }
   //echo $id; 
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
</head>

<body>
<strong><h1><a href ="index.php">FairHome Pro</a></h1></strong>
<hr>
   <h1>Possible Bids</h1>
<hr>
<table border="2">
      <tr>
      <td>Buisness</td>
      <td>Contact Information</td>
      <td>Service Area</td>
	  <td>Service</td>
	  <td>Quote</td>
	  <td>Status</td>
      </tr>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST["contractid"])){
if (empty($_POST["confirmation"])){

echo "<form action=services.php method=post>" .
"<input type=\"hidden\" name=\"confirmation\" value=\"Confirmed\">" . 
"<input type=\"hidden\" name=\"priceid\" value=\"". $_POST["priceid"] . "\">" .
"<input type=\"hidden\" name=\"businessname\" value=\"". $_POST["businessname"] . "\">".
"<input type=\"hidden\" name=\"cost\" value=\"". $_POST["quote"] . "\">".
"<input type=\"hidden\" name=\"homenumber\" value=\"". $_POST["homenumber"] . "\">".
"<input type=\"submit\" value=\"Confirm Contract\">" 
. "</form>";
} else {
$sql = mysqli_query($db, "SELECT MAX(ContractID) FROM `Contracts`");
$data = mysqli_fetch_assoc($sql);
$conID = $data["MAX(ContractID)"];
$conID = $conID + 1;

date_default_timezone_set("MST");
$sql = "INSERT INTO Contracts (PriceID ,DateOfContracts, Price, BusinessName, HomeNumber, ContractID, Accepted)
VALUES (" . $_POST["priceid"] . "," . "'" . date('Y-m-d') . "'" . ", " . $_POST["cost"] . ", " . "'" . $_POST["businessname"] . "'" . ", " . $_POST["homenumber"] . ", " . $conID . ", 0)";
$db->query($sql);
}
} else {
	$sql = "DELETE FROM Contracts WHERE ContractID = " . $_POST["contractid"];
	$db->query($sql);
}
}
$servget = "SELECT ServiceName, BusinessName, PriceID FROM PricingQuotes";
$res = $db->query($servget);
if ($res->num_rows > 0) {
    // output data of each row
    while($row = $res->fetch_assoc()) {
	$sql = "SELECT * FROM ServiceProviders WHERE BusinessName='" . $row["BusinessName"] . "'";
	$result = $db->query($sql);
	$sqlA = "SELECT * FROM Owners WHERE AccountID=" . $_SESSION['id'];
	$resA = $db->query($sqlA);
	$rowA = $resA->fetch_assoc();
	$sqlB = "SELECT * FROM Contracts WHERE HomeNumber='" . $rowA["HomeNumber"] . "' AND BusinessName='" . $row["BusinessName"] . "' AND PriceID=" . $row["PriceID"];
	$resB = $db->query($sqlB);
	if($result->num_rows > 0){
	while($rows = $result->fetch_assoc()){
		$sql = "SELECT Cost, PerWhat, PriceID FROM PricingQuotes WHERE ServiceName='" . $row["ServiceName"] . 
		"' AND BusinessName='" . $row["BusinessName"] . "'";
		$result = $db->query($sql);
		$service = $result->fetch_assoc();
		$PriceID = $service["PriceID"];
		$cost = $service["Cost"];
		$perwhat = $service["PerWhat"];
		$sql = mysqli_query($db, "SELECT * FROM `Owners` WHERE AccountID = $id");
		$data = mysqli_fetch_assoc($sql);
		$homenumber = $data["HomeNumber"];
		$sql = "SELECT " . $perwhat . " FROM HomeDetails WHERE HomeNumber=" . $homenumber;
		$result = $db->query($sql);
		$data = $result->fetch_assoc();
		$quote = $cost * $data[$perwhat];
		
		
		if($resB->num_rows > 0){
			$rowB = $resB->fetch_assoc();
	
		if($rowB["Accepted"] == 0 AND $rowB["PriceID"] == $row["PriceID"] ){
			echo "<tr>";
			echo "<td>". $row["BusinessName"] ;
			echo "<td>". $rows["ContactInformation"] ;    
			echo "<td>". $rows["ServiceArea"];
			echo "<td>". $row["ServiceName"];
			echo "<td>". $quote;
			echo "<td> pending";
		} else if($rowB["Accepted"] == 1 AND $rowB["PriceID"] == $row["PriceID"]){
			echo "<tr>";
			echo "<td>". $row["BusinessName"] ;
			echo "<td>". $rows["ContactInformation"] ;    
			echo "<td>". $rows["ServiceArea"] ;
			echo "<td>". $row["ServiceName"];
			echo "<td>". $quote;
			echo "<td> accepted";
		} else if($rowB["PriceID"] == $row["PriceID"]){
			echo "<tr>";
			echo "<td>". $row["BusinessName"] ;
			echo "<td>". $rows["ContactInformation"] ;    
			echo "<td>". $rows["ServiceArea"] ;
			echo "<td>". $row["ServiceName"];
			echo "<td>". $quote;
			echo "<td> Rejected";
			echo "<td>" . "<form action=services.php method=post>" .
			"<input type=\"hidden\" name=\"contractid\" value=\"". $rowB["ContractID"]."\">".
			"<input type=\"hidden\" name=\"contractStatus\" value=\"delete\">".
			"<input type=\"submit\" value=\"ok\">" 
			. "</form>";
		} else {
			echo "<tr>";
			echo "<td>". $row["BusinessName"] ;
			echo "<td>". $rows["ContactInformation"] ;    
			echo "<td>". $rows["ServiceArea"] ;
			echo "<td>" . "<form action=services.php method=post>" .
			"<input type=\"hidden\" name=\"quote\" value=\"". $quote . "\">" .
			"<input type=\"hidden\" name=\"homenumber\" value=\"". $homenumber . "\">".
			"<input type=\"hidden\" name=\"priceid\" value=\"". $row["PriceID"] . "\">" .
			"<input type=\"hidden\" name=\"servicename\" value=\"". $row["ServiceName"] . "\">" .
			"<input type=\"hidden\" name=\"businessname\" value=\"". $row["BusinessName"] . "\">".
			"<input type=\"submit\" value=\"". $row["ServiceName"] . "\">" 
			. "</form>";
			echo "<td>". $quote;
			echo "<td> Unrequested";
		}
	}
	else {
		echo "<tr>";
		echo "<td>". $row["BusinessName"] ;
		echo "<td>". $rows["ContactInformation"] ;    
		echo "<td>". $rows["ServiceArea"] ;
		echo "<td>" . "<form action=services.php method=post>" .
		"<input type=\"hidden\" name=\"quote\" value=\"". $quote . "\">" .
		"<input type=\"hidden\" name=\"homenumber\" value=\"". $homenumber . "\">".
		"<input type=\"hidden\" name=\"priceid\" value=\"". $row["PriceID"] . "\">" .
		"<input type=\"hidden\" name=\"servicename\" value=\"". $row["ServiceName"] . "\">" .
		"<input type=\"hidden\" name=\"businessname\" value=\"". $row["BusinessName"] . "\">".
		"<input type=\"submit\" value=\"". $row["ServiceName"] . "\">" 
		. "</form>";
		echo "<td>". $quote;
		echo "<td> Unrequested";
	}
	}	
	}
    }
} else {
    echo "0 results";
}
?>  
</table>
</body>
</html>
<?php } 
else
{
   echo "Not Logged in";
   header("Location: login.php?error=You cannot access this page without being logged in");
}
?> 
