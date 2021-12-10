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
echo  "<form action=disputesBusiness.php method=post>" .
		"<input type=\"hidden\" name=\"contractid\" value=\"". $_POST["contractid"] . "\">" .
		"<input type=text name=disputedetails>" .
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
echo($sql);
$db->query($sql);
$result = $db->query($sql);
}
}
$insql = "SELECT HomeNumber FROM Owners WHERE AccountID=" . $_SESSION['id'];
$inres = $db->query($insql);
$OwnRole = $inres->fetch_assoc();
$sql = "SELECT * FROM Contracts WHERE HomeNumber=" . $OwnRole["HomeNumber"] . " AND Accepted=1";
$result = $db->query($sql);
$servget = "";
if ($result != false)
if ($result->num_rows >= 1) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$insqll = "SELECT ServiceName FROM PricingQuotes WHERE PriceID='" . $row["PriceID"] . "'";
	$inresn = $db->query($insqll);
	$OwnRoleo = $inresn->fetch_assoc();
	$sqlQ = "SELECT ContactInformation FROM ServiceProviders WHERE BusinessName='" . $row["BusinessName"] . "'";
	$inresQ = $db->query($sqlQ);
	$OwnRoleQ = $inresQ->fetch_assoc();
	echo "<tr>";
	echo "<td>". $row["BusinessName"];
	echo "<td>". $row["Price"];    
	echo "<td>". $OwnRoleQ["ContactInformation"];
	echo "<td>". $row["DateOfContracts"];
	echo "<td>". $OwnRoleo["ServiceName"];
	$insqlC = "SELECT * FROM Disputes WHERE ContractID=" . $row["ContractID"];
	$inresC = $db->query($insqlC);
	if($inresC->num_rows > 0){
		echo "<td>pending";
	} else {
	echo "<td>" . "<form action=disputesBusiness.php method=post>" .
		"<input type=\"hidden\" name=\"contractid\" value=\"". $row["ContractID"] . "\">" .
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