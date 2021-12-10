<?php include('ConnectLogin.php');
session_start();
if (isset($_SESSION['id']))
{
   if(is_numeric($_SESSION['id']))
   {
      echo "You are not a business, therefore you cannot accept contracts.";
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
   <h1>Requested Contracts</h1>
<hr>
<table border="2">
      <tr>
      <td>Name</td>
	  <td>Price</td>
      <td>Contact Information</td>
      <td>Date Requested</td>
	  <td>Service</td>
	  <td>Accept</td>
	  <td>Deny</td>
	  <td>Status</td>
      </tr>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST["accepted"])){
	
	$sql = "UPDATE Contracts SET Accepted=2 WHERE ContractID=" . $_POST["contractid"];
	$result = $db->query($sql);
	
	
} else {
	
	$sql = "UPDATE Contracts SET Accepted=1 WHERE ContractID=" . $_POST["contractid"];
	$result = $db->query($sql);
	
}
}
$sql = "SELECT * FROM Contracts WHERE BusinessName='" . $_SESSION["id"] . "'";
$result = $db->query($sql);
$servget = "";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$insql = "SELECT Name, EmailAddress FROM Owners WHERE HomeNumber='" . $row["HomeNumber"] . "'";
	$inres = $db->query($insql);
	$OwnRole = $inres->fetch_assoc();
	$insqll = "SELECT ServiceName FROM PricingQuotes WHERE PriceID='" . $row["PriceID"] . "'";
	$inresn = $db->query($insqll);
	$OwnRoleo = $inresn->fetch_assoc();
	echo "<tr>";
	echo "<td>". $OwnRole["Name"];
	echo "<td>". $row["Price"];    
	echo "<td>". $OwnRole["EmailAddress"];
	echo "<td>". $row["DateOfContracts"];
	echo "<td>". $OwnRoleo["ServiceName"];
	if($row["Accepted"] == 1){
	echo "<td><td>";
	echo "<td> Accepted";
	
	} else if ($row["Accepted"] == 2){
	echo "<td><td>";
	echo "<td> Rejected"; 
	} else{
	echo "<td>" . "<form action=newContracts.php method=post>" .
		"<input type=\"hidden\" name=\"contractid\" value=\"". $row["ContractID"] . "\">" .
		"<input type=\"hidden\" name=\"accepted\" value=\"1\">" .
		"<input type=\"submit\" value=\"Accept\">" 
		. "</form>";
	echo "<td>" . "<form action=newContracts.php method=post>" .
		"<input type=\"hidden\" name=\"contractid\" value=\"". $row["ContractID"] . "\">" .
		"<input type=\"submit\" value=\"Deny\">" 
		. "</form>";
	echo "<td>Pending";
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