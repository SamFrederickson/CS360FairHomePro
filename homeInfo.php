<?php include('ConnectLogin.php');
session_start();

$fid= $_SESSION['id'];
$id = (int)$fid;
?>
<!DOCTYPE html>
<html>
<head>
<title>My Home Page</title>
</head>

<body>
   <strong><h1><a href ="index.php">FairHome Pro</a></h1></strong>
   <hr>
   <h1>My Home</h1>
   <hr>
   <table border="2">
      <tr>
      <td>Home ID</td>
      <td>Address</td>
      <td>Home Price</td>
      <td>Type of Home</td>
      <td>Floor SqFt</td>
      <td>Construction Type</td>
      <td>Yard SqFt</td>
      <td>Garage Size</td>
      <td>Bathrooms</td>
      <td>Bedrooms</td>
      <td>Service Area</td>
   </tr>
<?php
   $sql = mysqli_query($db, "SELECT * FROM `Owners` WHERE AccountID = $id");
   if(mysqli_num_rows($sql) === 1)
   {
      $data = mysqli_fetch_assoc($sql);
      $home = $data['HomeNumber'];
      $query = mysqli_query($db, "SELECT * FROM `HomeDetails` WHERE HomeNumber = $home");
      if(mysqli_num_rows($query) === 1)
      {
          $info = mysqli_fetch_assoc($query);
   ?>
   <td><?php echo $info['HomeNumber']; ?></td>
   <td><?php echo $info['Address']; ?></td>
   <td><?php echo $info['HomePrice']; ?></td>
   <td><?php echo $info['TypeOfHome']; ?></td>
   <td><?php echo $info['FloorSqFt']; ?></td>
   <td><?php echo $info['ConstructionsType']; ?></td>
   <td><?php echo $info['YardSqFt']; ?></td>
   <td><?php echo $info['GarageSize']; ?></td>
   <td><?php echo $info['Bathrooms']; ?></td>
   <td><?php echo $info['Bedrooms']; ?></td>
   <td><?php echo $info['Area']; ?></td>

  <?php
      }
}?>
</table>
<?php mysqli_close($db); ?>

</body>
</html> 