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
      </tr>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST["contractid"])){
if (empty($_POST["confirmation"])){
$sql = "SELECT Cost, PerWhat, PriceID FROM PricingQuotes WHERE ServiceName='" . $_POST["servicename"] . 
"' AND BusinessName='" . $_POST["businessname"] . "'";
$servicename = $_POST["servicename"];
$result = $db->query($sql);
$service = $result->fetch_assoc();
$businessname = $_POST["businessname"];
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
echo "Quote: " . $quote . "\n";
echo "<form action=services.php method=post>" .
"<input type=\"hidden\" name=\"confirmation\" value=\"Confirmed\">" . 
"<input type=\"hidden\" name=\"priceid\" value=\"". $PriceID . "\">" .
"<input type=\"hidden\" name=\"businessname\" value=\"". $businessname . "\">".
"<input type=\"hidden\" name=\"cost\" value=\"". $quote . "\">".
"<input type=\"hidden\" name=\"homenumber\" value=\"". $homenumber . "\">".
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
$sql = "SELECT * FROM ServiceProviders";
$result = $db->query($sql);
$servget = "";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "<tr>";
	echo "<td>". $row["BusinessName"] ;
	echo "<td>". $row["ContactInformation"] ;    
	echo "<td>". $row["ServiceArea"] ;
	$sqlA = "SELECT * FROM Owners WHERE AccountID=" . $_SESSION['id'];
	$resA = $db->query($sqlA);
	$rowA = $resA->fetch_assoc();
	$sqlB = "SELECT * FROM Contracts WHERE HomeNumber='" . $rowA["HomeNumber"] . "' AND BusinessName='" . $row["BusinessName"] . "'";
	$resB = $db->query($sqlB);
	
    $servget = "SELECT ServiceName FROM PricingQuotes WHERE BusinessName='" . $row["BusinessName"] . "'";
	$res = $db->query($servget);
	if($res->num_rows > 0){
	while($rows = $res->fetch_assoc()){
	if($resB->num_rows > 0){
	$rowB = $resB->fetch_assoc();
	if($rowB["Accepted"] == 0){
		echo "<td> pending";
	} else if($rowB["Accepted"] == 1){
		echo "<td> accepted";
	} else {
		echo "<td> Rejected";
		echo "<td>" . "<form action=services.php method=post>" .
		"<input type=\"hidden\" name=\"contractid\" value=\"". $rowB["ContractID"]."\">".
		"<input type=\"hidden\" name=\"contractStatus\" value=\"delete\">".
		"<input type=\"submit\" value=\"ok\">" 
		. "</form>";
	}
	}
	else {
		echo "<td>" . "<form action=services.php method=post>" .
		"<input type=\"hidden\" name=\"servicename\" value=\"". $rows["ServiceName"] . "\">" .
		"<input type=\"hidden\" name=\"businessname\" value=\"". $row["BusinessName"] . "\">".
		"<input type=\"submit\" value=\"". $rows["ServiceName"] . "\">" 
		. "</form>";
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