<?php 
session_start();
// connect to the database
include "ConnectLogin.php";

$errors = 0;
$email = "";
$password = "";

if (isset($_POST['lgin_user'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($email)) {$errors = $errors + 1;}
    if(empty($password)) {$errors = $errors + 1;}

      if($errors == 0)
      {
         $user_check_query = "SELECT * FROM Owners WHERE EmailAddress = '$email'";
         $result = mysqli_query($db, $user_check_query);
         if(mysqli_num_rows($result) === 1)
         {
            $user = mysqli_fetch_assoc($result);
        
            if ($user['EmailAddress'] === $email && $user['Password'] === $password)
            {
               echo "Logged in!";
               $_SESSION['id'] = $user['AccountID'];
               header("Location: index.php");
            }
            else
            {
               header("Location: login.php?error=Incorrect password");
               exit();
            }  
         }
         else
         {
            header("Location: login.php?error=Email does not exist");
            exit();
         }
      }
      else
      {
         header("Location: login.php?error=Field Not Filled in");
         exit();
      }
}
if (isset($_POST['login_bsn'])) {
   // receive all input values from the form
   $name = mysqli_real_escape_string($db, $_POST['busname']);
   $password = mysqli_real_escape_string($db, $_POST['password']);

   if(empty($name)) {$errors = $errors + 1;}
   if(empty($password)) {$errors = $errors + 1;}

     if($errors == 0)
     {
        $user_check_query = "SELECT * FROM ServiceProviders WHERE BusinessName = '{$name}'";
        $result = mysqli_query($db, $user_check_query);
        if(mysqli_num_rows($result) === 1)
        {
           $user = mysqli_fetch_assoc($result);
       
           if ($user['BusinessName'] === $name && $user['Password'] === $password)
           {
              echo "Logged in!";
              $_SESSION['id'] = $user['BusinessName'];
              header("Location: index.php");
           }
           else
           {
              header("Location: login.php?error=Incorrect password");
              exit();
           }  
        }
        else
        {
           header("Location: login.php?error=Business Name does not exist");
           exit();
        }
     }
     else
     {
        header("Location: login.php?error=Field Not Filled in");
        exit();
     }
}
?>