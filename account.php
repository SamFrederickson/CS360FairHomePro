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
   <?php if (isset($_GET['error'])) { ?>
   <p class="error"><?php echo $_GET['error']; ?></p>
   <?php } ?>
   <h1>My Account</h1>
   <hr>
   <h3><a href="displayBankinfo.php">Show bank info</a></h3><br>
   <table border="2">
   <?php if(is_numeric($id))
   {?>
      <tr>
      <td>AccountID</td>
      <td>HomeNumber</td>
      <td>Name</td>
      <td>Phone Number</td>
      <td>Email Address</td>
      <td>Password</td>
   </tr>
<?php
   $sql = mysqli_query($db, "SELECT * FROM `Owners` WHERE AccountID = $id");
   //print($sql);
   if(mysqli_num_rows($sql) === 1)
   {
      $data = mysqli_fetch_assoc($sql);
   ?>
   <td><?php echo $data['AccountID']; ?></td>
   <?php if($data['HomeNumber'] != NULL)
   {?>
   <td><a href="homeInfo.php"><?php echo $data['HomeNumber']; ?></a></td>
   <?php } else { ?> <td><?php echo "No Home Added Yet"; }; ?></td>
   <td><?php echo $data['Name']; ?></td>
   <td><?php echo $data['EmailAddress']; ?></td>
   <td><?php echo $data['TelephoneNumbers']; ?></td>
   <td><?php echo $data['Password']; ?></td>
   <?php if($data['HomeNumber'] != NULL)
   {?>
      <h3><a href="homeInfo.php">View your Home</a><h3>
   <?php } ?>
   <?php if($data['BankInformation'] == NULL)
   {?>
      <h3><a href="paymentPage.php">Add a Payment Method</a><h3>
   <?php } ?>


  <?php }
  }
  else if(!is_numeric($id))
  { ?>
      <tr>
      <td>BusinessName</td>
      <td>Phone Number</td>
      <td>Speciality</td>
      <td>Liscence</td>
      <td>Password</td>
      <td>ServiceArea</td>
   </tr>
<?php
   $sql = mysqli_query($db, "SELECT * FROM `ServiceProviders` WHERE BusinessName = '$id'");
   if(mysqli_num_rows($sql) === 1)
   {
      $data = mysqli_fetch_assoc($sql);
   ?>
   <td><?php echo $data['BusinessName']; ?></td>
   <td><?php echo $data['ContactInformation']; ?></td>
   <td><?php echo $data['Speciality']; ?></td>
   <td><?php echo $data['Liscence']; ?></td>
   <td><?php echo $data['Password']; ?></td>
   <td><?php echo $data['ServiceArea']; ?></td>
   <h3><a href ="newContracts.php"> Check for contracts </a></h3><br>
   <h3><a href ="addServicePage.php">Add a service to your buisiness</a></h3><br>
   <?php if($data['BankInformation'] == NULL)
   {?>
      <h3><a href="paymentPage.php">Add a Payment Method</a><h3>
   <?php } ?>
  <?php } ?>
</table>
<hr>
<h1>Services</h1>
<hr>
<table border="2">
<tr>
   <td>Business Name</td>
   <td>PriceID</td>
   <td>Per</td>
   <td>Cost(USD)</td>
   <td>Service Name</td>
</tr>
  <?php } ?>
  <?php
   $sql = mysqli_query($db, "SELECT * FROM `PricingQuotes` WHERE BusinessName = '$id'");
   if(mysqli_num_rows($sql) >= 1)
   {
      while($data = mysqli_fetch_assoc($sql))
      {
      ?>
      <tr>
      <td><?php echo $data['BusinessName']; ?></td>
      <td><?php echo $data['PriceID']; ?></td>
      <td><?php echo $data['PerWhat']; ?></td>
      <td><?php echo $data['Cost']; ?></td>
      <td><?php echo $data['ServiceName']; ?></td>
      </tr>
      <?php   
      }
   }
 mysqli_close($db); ?>

</body>
</html>
<?php } 
else
{
   echo "Not Logged in";
   header("Location: login.php?error=You cannot access this page without being logged in");
}
?> 