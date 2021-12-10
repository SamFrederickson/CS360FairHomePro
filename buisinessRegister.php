<?php include('server.php') ?>
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
  	<h2>Register Your Buisiness</h2>
  </div>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  	<div class="input-group">
  	  <label>Business Name</label>
  	  <input type="text" name="name">
	</div>
  	<div class="input-group">
  	  <label>Phone Number</label>
  	  <input type="text" name="contact">
  	</div>
     <div class="input-group">
  	  <label>Speciality</label>
  	  <input type="text" name="service">
  	</div>
     <div class="input-group">
  	  <label>Liscence</label>
  	  <input type="text" name="license">
  	</div>
     <div class="input-group">
  	  <label>Service Area</label>
  	  <input type="text" name="area">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_bus">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="buisinessLogin.php">Sign in to your Business</a>
  	</p>
  </form>
</body>
</html>