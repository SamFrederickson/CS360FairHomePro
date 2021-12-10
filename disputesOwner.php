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
   <h1>Disputes</h1>
<hr>
<table border="2">
      <tr>
      <td>Buisness Name</td>
	  <td>Price</td>
      <td>Contact Information</td>
      <td>Date Requested</td>
	  <td>Service</td>
	  <td>Dispute</td>
      </tr>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST["disputedetails"])){
echo  "<form action=disputesOwner.php method=post>" .
		"<input type=text name=disputedetails>" .
      "<input type=\"hidden\" name=\"contractid\" value=\"". $_POST["contractid"] . "\">" .
		"<input type=\"submit\" value=\"Dispute\">" 
		. "</form>";
} else {
$sql = mysqli_query($db, "SELECT MAX(DisputeID) FROM `Disputes`");
$data = mysqli_fetch_assoc($sql);
$disID = $data["MAX(DisputeID)"];
$disID = $disID + 1;

date_default_timezone_set("MST");
$sql = "INSERT INTO Disputes(ContractID, DisputeDate, DisputeDetails, DisputeID)
VALUES (" . $_POST["contractid"] . "," . "'" . date('Y-m-d') . "'" . ", '" . $_POST["disputedetails"] . "', " . $disID . ")";
//echo($sql);
$db->query($sql);
$result = $db->query($sql);
}
}

$sqlA = "SELECT * FROM Contracts WHERE BusinessName='" . $_SESSION['id'] . "' AND Accepted=1";
$resultA = $db->query($sqlA);
$servget = "";
if ($resultA != false)
if ($resultA->num_rows >= 1) {
    // output data of each row
    while($rowA = $resultA->fetch_assoc()) {
	$insql = "SELECT Name, EmailAddress FROM Owners WHERE HomeNumber=" . $rowA["HomeNumber"];
	$inres = $db->query($insql);
	$OwnRole = $inres->fetch_assoc();
	$insqll = "SELECT ServiceName FROM PricingQuotes WHERE PriceID='" . $rowA["PriceID"] . "'";
	$inresn = $db->query($insqll);
	$OwnRoleo = $inresn->fetch_assoc();
	echo "<tr>";
	echo "<td>". $OwnRole["Name"];
	echo "<td>". $rowA["Price"];    
	echo "<td>". $OwnRole["EmailAddress"];
	echo "<td>". $rowA["DateOfContracts"];
	echo "<td>". $OwnRoleo["ServiceName"];
	$insqlC = "SELECT * FROM Disputes WHERE ContractID=" . $rowA["ContractID"];
	$inresC = $db->query($insqlC);
	if($inresC->num_rows > 0){
		echo "<td>pending";
	} else {
	echo "<td>" . "<form action=disputesOwner.php method=post>" .
		"<input type=\"hidden\" name=\"contractid\" value=\"". $rowA["ContractID"] . "\">" .
		"<input type=\"submit\" value=\"Dispute\">" 
		. "</form>";
	}
    }
} else {
    echo "No new contracts.";
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