<?php include('ConnectLogin.php');
session_start();
$errors = 0;
if (isset($_SESSION['id']))
{
   if(is_numeric($_SESSION['id']))
   {
      echo "You are not a business, therefore you cannoot add services";
      header("Location: account.php");
   }
   else
   {
      $id = $_SESSION['id'];
      if (isset($_POST['reg_serv'])) {
           // receive all input values from the form
           $per = mysqli_real_escape_string($db, $_POST['per']);
           $cost = mysqli_real_escape_string($db, $_POST['cost']);
           $name = mysqli_real_escape_string($db, $_POST['name']);
         
           // form validation: ensure that the form is correctly filled ...
           // by adding (array_push()) corresponding error unto $errors array
           if (empty($name)) { header("Location: addServicePage.php?error=No Service Name Entered"); exit(); $errors = $errors + 1; }
           if (empty($per)) { header("Location: addServicePage.php?error=Nothing identified on line per"); exit(); $errors = $errors + 1;}
           if (empty($cost)) { header("Location: addServicePage.php?error=No cost Enetered"); exit(); $errors = $errors + 1;}

         
           // first check the database to make sure 
           // a user does not already exist with the same username and/or email
           $user_check_query = "SELECT * FROM `PricingQuotes` WHERE `BusinessName` = '{$id}' AND ServiceName = '$name'";
           $result = mysqli_query($db, $user_check_query);
           $user = mysqli_fetch_assoc($result);
         
             if ($user['BusinessName'] === $id && $user['ServiceName'] == $name)
             {
               header("Location: addServicePage.php?error=You already have an existing service named this"); exit();
               $errors = $errors + 1;
             }
            $querycheck = "SELECT MAX(PriceID) FROM PricingQuotes";
            $result = mysqli_query($db, $querycheck);
            $row = $result->fetch_assoc();
            $accountID = $row["MAX(PriceID)"];
            $accountID++;
           // Finally, register user if there are no errors in the form
           if ($errors == 0) { 
         
              $query = "INSERT INTO PricingQuotes (`Cost`, `PerWhat`, `PriceID`, `BusinessName`, `ServiceName`) 
                      VALUES('$cost', '$per', '$accountID','$id', '$name')";
            //echo "Successfully added";
            echo $query;
              if ($db->query($query) === TRUE){
             //echo "epic";
             //header("Location: account.php");
            } else {
            //echo "not epic";
            }
           }
         }


   }  //echo $id; 
}
else{
   echo "You must first login";
   header("Location: buisinessLogin.php?error=You are not logged in");
}
?>