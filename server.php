<?php
session_start();

// initializing variables
$accountID = "";
$name = $nameerr = "";
$email    = $emailerr = $passworderr = "";
$telephone = $telephoneerr = "";
$errors = 0;

// connect to the database
include "ConnectLogin.php";



// REGISTER USER
if (isset($_POST['reg_user'])) {
$querycheck = "SELECT MAX(AccountID) FROM Owners";
$result = mysqli_query($db, $querycheck);
$row = $result->fetch_assoc();
$accountID = $row["MAX(AccountID)"];
$accountID++;
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { header("Location: register.php?error=No Name Entered"); exit(); $errors = $errors + 1; }
  if (empty($email)) { header("Location: register.php?error=No Email entered"); exit(); $errors = $errors + 1;}
  if (empty($telephone)) { header("Location: register.php?error=No Phone number entered"); exit(); $errors = $errors + 1;}
  if (empty($password_1)) { header("Location: register.php?error=No password entered"); exit(); $errors = $errors + 1;}
  if ($password_1 != $password_2) { header("Location: register.php?error=Password Mismatch"); exit(); $errors = $errors + 1;}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM `Owners` WHERE `EmailAddress` = '{$email}' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

    if ($user['EmailAddress'] === $email) 
    {
      header("Location: register.php?error=email already exists"); exit();
      $errors = $errors + 1;
    }

  // Finally, register user if there are no errors in the form
  if ($errors == 0) { 
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO Owners (`AccountID`, `HomeNumber`, `Name`, `TelephoneNumbers`, `EmailAddress`, `Password`, `CreditCard`, `BankInformation`) 
  			  VALUES('$accountID', NULL, '$name', '$telephone','$email', '$password', NULL, NULL)";
   //echo "Successfully added";
   //echo $query;
  	if ($db->query($query) === TRUE){
	 //echo "epic";
	} else {
	 //echo "not epic";
	}
   $_SESSION['id'] = $accountID;

  	$_SESSION['success'] = "You are now logged in";
   header("Location: index.php");
  }
}

//Register Business
if (isset($_POST['reg_bus'])) {
     // receive all input values from the form
     $name = mysqli_real_escape_string($db, $_POST['name']);
     $telephone = mysqli_real_escape_string($db, $_POST['contact']);
     $special = mysqli_real_escape_string($db, $_POST['service']);
     $area = mysqli_real_escape_string($db, $_POST['area']);
     $license = mysqli_real_escape_string($db, $_POST['license']);
     $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
     $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
   
     // form validation: ensure that the form is correctly filled ...
     // by adding (array_push()) corresponding error unto $errors array
     if (empty($name)) { header("Location: buisinessRegister.php?error=No Business Name Entered"); exit(); $errors = $errors + 1; }
     if (empty($telephone)) { header("Location: buisinessRegister.php?error=No phone number entered"); exit(); $errors = $errors + 1;}
     if (empty($special)) { header("Location: buisinessRegister.php?error=No service entered"); exit(); $errors = $errors + 1;}
     if (empty($password_1)) { header("Location: buisinessRegister.php?error=No password entered"); exit(); $errors = $errors + 1;}
     if ($password_1 != $password_2) { header("Location: buisinessRegister.php?error=Password Mismatch"); exit(); $errors = $errors + 1;}
   
     // first check the database to make sure 
     // a user does not already exist with the same username and/or email
     $user_check_query = "SELECT * FROM ServiceProviders WHERE BusinessName = '{$name}' LIMIT 1";
     $result = mysqli_query($db, $user_check_query);
     $user = mysqli_fetch_assoc($result);
   
       if ($user['BusinessName'] === $name) 
       {
         header("Location: buisinessRegister.php?error=Business already exists"); exit();
         $errors = $errors +1;
       }
   
     // Finally, register user if there are no errors in the form
     if ($errors == 0) { 
        $password = $password_1;//encrypt the password before saving in the database
   
        $query = "INSERT INTO ServiceProviders (BusinessName, ContactInformation, `Password`, Speciality, Liscence, ServiceArea) 
                VALUES('$name','$telephone', '$password', '$special','$license','$area')";
      //echo "Successfully added";
      //echo $query;
        if ($db->query($query) === TRUE){
       //echo "epic";
         $_SESSION['id'] = $name;
   
         $_SESSION['success'] = "You are now logged in";
         header("Location: index.php");
      } else {
       //echo "not epic";
       quit();
      }
     }
}
?>