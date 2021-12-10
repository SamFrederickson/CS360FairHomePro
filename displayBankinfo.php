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
   <h1>My Payment Information</h1>
   <hr>

   <table border="2">
   <?php if(is_numeric($id))
   {?>
      <tr>
      <td>Credit Card</td>
      <td>Bank Information</td>
   </tr>
   <?php
   $sql = mysqli_query($db, "SELECT * FROM `Owners` WHERE AccountID = $id");

   if(mysqli_num_rows($sql) === 1)
   {
      $data = mysqli_fetch_assoc($sql);?>
      <td><?php echo $data['CreditCard']; ?></td>
      <td><?php echo $data['BankInformation']; ?></td>
    <?php } else { 

   }
  }
  else if(!is_numeric($id))
  { ?>
      <tr>
      <td>Credit Card</td>
      <td>Bank Information</td>
   </tr>
<?php
   $sql = mysqli_query($db, "SELECT * FROM `ServiceProviders` WHERE BusinessName = '$id'");
   if(mysqli_num_rows($sql) === 1)
   {
      $data = mysqli_fetch_assoc($sql);
   ?>
   <td><?php echo $data['CreditCard']; ?></td>
   <td><?php echo $data['BankInformation']; ?></td>
  <?php }
  }?>
</table>
<?php mysqli_close($db); ?>

</body>
</html>
<?php } 
else
{
   echo "Not Logged in";
   header("Location: login.php?error=You cannot access this page without being logged in");
}
?> 