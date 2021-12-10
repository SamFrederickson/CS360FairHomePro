<?php include('payment.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>PaymentPage</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<strong><h1><a href ="index.php">FairHome Pro</a></h1></strong>
<hr>
<?php if (isset($_GET['error'])) { ?>
<p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
<div class = "header">
   <h2>Payment Information</h2>
</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<div class="input-group">
   <label>Card Number</label>
   <input type="text" name="card">
</div>
<div class="input-group">
   <label>Bank Address</label>
   <input type="text" name="bank">
</div>
<div class="input-group">
   <?php if(is_numeric($_SESSION['id']))
   {?>
      <button type="submit" class="btn" name="add_payment">Submit</button>
 <?php  }
   else
   {?>
      <button type="submit" class="btn" name="add_payment_bus">Submit</button>
  <?php } ?>
</div>
</form>
</body>
</html> 