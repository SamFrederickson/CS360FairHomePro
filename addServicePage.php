<?php include('addService.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Add a service to your business</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<strong><h1><a href ="index.php">FairHome Pro</a></h1></strong>
<?php if (isset($_GET['error'])) { ?>
<p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
  <div class="header">
  	<h2>Add a Service</h2>
  </div>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  	<div class="input-group">
  	  <label for="per">Per ______ (sqft, sqIn, yard, etc...)</label>
      <select id="per" name="per">
         <option value="FloorSqFt">Floor SqFt</option>
         <option value="YardSqFt">Yard SqFt</option>
         <option value="GarageSize">Garage</option>
         <option value="Bedrooms">Bedroom</option>
         <option value="Bathrooms">Bathroom</option>
      </select>
  	</div>
     <div class="input-group">
  	  <label>Cost in USD(per above field)(no $)</label>
  	  <input type="text" name="cost">
  	</div>
     <div class="input-group">
  	  <label>Service Name</label>
  	  <input type="text" name="name">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_serv">Register Service</button>
  	</div>
  	<p>
  		Not meaning to be here? <a href="account.php">Back to your account</a>
  	</p>
  </form>
</body>
</html>