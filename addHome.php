<?php 
session_start();
// connect to the database
include "ConnectLogin.php";

$errors = 0;
$email = "";
$password = "";
$fid= $_SESSION['id'];
$id = (int)$fid;
//echo "$fid";

   $querycheck = "SELECT MAX(HomeNumber) FROM HomeDetails";
   $result = mysqli_query($db, $querycheck);
   $row = $result->fetch_assoc();
   $accountID = $row["MAX(HomeNumber)"];
   $accountID++;
   //echo "$accountID";
   $homenumber = $accountID;
if (isset($_POST['reg_house'])) {
    // receive all input values from the form
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $price = mysqli_real_escape_string($db, $_POST['homeprice']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $housesqft = mysqli_real_escape_string($db, $_POST['hsqft']);
    $construct = mysqli_real_escape_string($db, $_POST['construct']);
    $yardsqft = mysqli_real_escape_string($db, $_POST['ysqft']);
    $garage = mysqli_real_escape_string($db, $_POST['garage']);
    $bath = mysqli_real_escape_string($db, $_POST['bath']);
    $bed = mysqli_real_escape_string($db, $_POST['bed']);
    $area = mysqli_real_escape_string($db, $_POST['area']);

    if(empty($accountID)) { header("Location: addHomePage.php?error=HomeError"); $errors = $errors + 1;}
    if(empty($address)) {header("Location: addHomePage.php?error=No Address Entered"); $errors = $errors + 1;}
    if(empty($type)) {header("Location: addHomePage.php?error=No Type of house Entered"); $errors = $errors + 1;}
    if(empty($housesqft)) {header("Location: addHomePage.php?error=no house sqft entered"); $errors = $errors + 1;}
    if(empty($yardsqft)) {header("Location: addHomePage.php?error=No yard sqft Entered"); $errors = $errors + 1;}
    if(empty($bath)) {header("Location: addHomePage.php?error=No bathrooms Entered"); $errors = $errors + 1;}
    if(empty($bed)) {header("Location: addHomePage.php?error=No bedrooms Entered"); $errors = $errors + 1;}
    if(empty($area)) {header("Location: addHomePage.php?error=No area Entered"); $errors = $errors + 1;}

   $user_check_query = "SELECT * FROM HomeDetails WHERE `Address` = '$address'";
   $result = mysqli_query($db, $user_check_query);
   if(mysqli_num_rows($result) === 1)
   {
      header("Location: addHomePage.php?error=Address already exists"); exit();
      $errors = $errors + 1;
   }
   if($errors == 0)
   {
      $query = "INSERT INTO HomeDetails (`HomeNumber`, `Address`, `HomePrice`, `TypeOfHome`, `FloorSqFt`, `ConstructionsType`, `YardSqFt`, `TypesOfPlants`, `GarageSize`, `Bathrooms`, `Bedrooms`, `Area`) 
  			  VALUES('$accountID', '$address', '$price', '$type', '$housesqft', '$construct', '$yardsqft', NULL, '$garage', '$bath', '$bed', '$area')";
      //echo "Successfully added";
   //echo $query;
  	if ($db->query($query) === TRUE){
	 //echo "epic";
    $sql = "UPDATE `Owners` SET `HomeNumber` = $homenumber WHERE AccountID = $id";
    if ($db->query($sql) === TRUE) {
      //echo "Record updated successfully";
      header("Location: account.php");
    } else {
      //echo "Error updating record: " . $conn->error;
    }
	} else {
	 echo "not epic";
	}
  }
  else
  {
     echo "an error occured";
  }
}
?>