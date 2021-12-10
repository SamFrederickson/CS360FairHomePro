<?php include('ConnectLogin.php');
session_start();
$errors = 0;
if (isset($_SESSION['id']))
{
   if(is_numeric($_SESSION['id']))
   {
      //echo "session1";
      $id = (int)$_SESSION['id'];
      if (isset($_POST['add_payment'])) {
           // receive all input values from the form
           $card = mysqli_real_escape_string($db, $_POST['card']);
           $bank = mysqli_real_escape_string($db, $_POST['bank']);
         
           // form validation: ensure that the form is correctly filled ...
           // by adding (array_push()) corresponding error unto $errors array
           if (empty($card)) { header("Location: paymentPage.php?error=No Credit Card Entered"); exit(); $errors = $errors + 1; }
           if (empty($bank)) { header("Location: paymentPage.php?error=No Bank Information Entered"); exit(); $errors = $errors + 1;}

           // Finally, register user if there are no errors in the form
           if ($errors == 0) { 
         
              $query = "UPDATE Owners
              SET CreditCard = '$card', BankInformation = '$bank'
              WHERE AccountID = $id";
             //echo "Successfully added";
             echo $query;
             if ($db->query($query) === TRUE){
             echo "epic";
             header("Location: account.php?error=Bank Information Added!");
            } else {
            echo "not epic";
            }
           }
         }
   }
   else
   {
      //echo "session2";
      $id = $_SESSION['id'];
      if (isset($_POST['add_payment_bus'])) {
           // receive all input values from the form
           $card = mysqli_real_escape_string($db, $_POST['card']);
           $bank = mysqli_real_escape_string($db, $_POST['bank']);
         
           // form validation: ensure that the form is correctly filled ...
           // by adding (array_push()) corresponding error unto $errors array
           if (empty($card)) { header("Location: paymentPage.php?error=No Credit Card Entered"); exit(); $errors = $errors + 1; }
           if (empty($bank)) { header("Location: paymentPage.php?error=No Bank Information Entered"); exit(); $errors = $errors + 1;}

           // Finally, register user if there are no errors in the form
           if ($errors == 0) { 
         
              $query = "UPDATE ServiceProviders
              SET CreditCard = '$card', BankInformation = '$bank'
              WHERE BusinessName = '{$id}'";
             //echo "Successfully added";
             //echo $query;
             if ($db->query($query) === TRUE){
             //echo "epic";
             header("Location: account.php?error=Bank Information Added!");
            } else {
            //echo "not epic";
            }
           }
         }
   }  //echo $id; 
}
else{
   echo "You must first login";
   header("Location: Login.php?error=You are not logged in");
}
?>