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
  	<h2>Register</h2>
  </div>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="name">
	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email">
  	</div>
     <div class="input-group">
  	  <label>Telephone Number</label>
  	  <input type="text" name="telephone">
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
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>