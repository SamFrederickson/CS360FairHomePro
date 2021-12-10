<?php 
session_start();
// connect to the database
include "ConnectLogin.php";
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
} 
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
</head>

<body>
   <strong><h1><a href ="index.php">FairHome Pro</a></h1></strong>
   <hr>
   <h1>Home</h1>
   <div>
      <hr>
      <br>
      <?php if (isset($_SESSION['id'])) 
      { ?>
      <?php
         if(is_numeric($_SESSION['id']))
         {
            $sql = mysqli_query($db, "SELECT * FROM `Owners` WHERE AccountID = $id");
            if(mysqli_num_rows($sql) === 1)
            {
               $data = mysqli_fetch_assoc($sql);
               if($data['HomeNumber'] == NULL)
               {?>
                  <a href="addHomePage.php">Add a Home</a><br>
               <?php }
            }?>
            <a href="disputesBusiness.php">Dispute Business</a><br>
            <a href ="services.php">Service Page</a><br>
        <?php } else
               {
               ?>
			      <a href="disputesOwner.php">Dispute Owner</a><br>
			      <?php
               }
      ?>
         <a href="logout.php">Logout</a><br>
         <a href="account.php">My Account</a><br>
      <?php } 
       else
      {  ?>
         <a href="register.php">Register</a><br>
         <a href="login.php">Login</a><br>
         <a href="buisinessLogin.php">Business Login Page</a><br>
         <a href="buisinessRegister.php">Register your Business</a><br>
      <?php } ?>
      <br>
      <hr>
      <strong>Designers: </strong>Samuel Frederickson, Zachary Hale, Chase Gornick<br>

    </div>

   
     
</body>
</form>

</body>
</html> 
