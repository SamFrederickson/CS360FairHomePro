<?php include('addHome.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<strong><h1><a href ="index.php">FairHome Pro</a></h1></strong>
<?php if (isset($_GET['error'])) { ?>
<p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
  <div class="header">
  	<h2>Add Your Home Now!</h2>
  </div>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  	<div class="input-group">
  	  <label>Address</label>
  	  <input type="text" name="address">
	</div>
  	<div class="input-group">
  	  <label>HomePrice</label>
  	  <input type="text" name="homeprice">
  	</div>
     <div class="input-group">
  	  <label>Type Of Home(Cottage, Apartment, etc...)</label>
  	  <input type="text" name="type">
  	</div>
  	<div class="input-group">
  	  <label>House SqFt</label>
  	  <input type="text" name="hsqft">
  	</div>
  	<div class="input-group">
  	  <label>Construction Type</label>
  	  <input type="text" name="construct">
  	</div>
     <div class="input-group">
  	  <label>Yard SqFt</label>
  	  <input type="text" name="ysqft">
  	</div>
     <div class="input-group">
  	  <label>Garage Size</label>
  	  <input type="text" name="garage">
  	</div>
     </div>
     <div class="input-group">
  	  <label>Bathrooms</label>
  	  <input type="text" name="bath">
  	</div>
     </div>
     <div class="input-group">
  	  <label>Bedrooms</label>
  	  <input type="text" name="bed">
  	</div>
   </div>
     <div class="input-group">
  	  <label>Area</label>
  	  <input type="text" name="area">
  	</div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_house">Register House</button>
  	</div>
  </form>
</body>
</html>