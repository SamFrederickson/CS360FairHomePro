<?php include('authentication.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<strong><h1><a href ="index.php">FairHome Pro</a></h1></strong>
<hr>
<?php if (isset($_GET['error'])) { ?>
<p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
<div class = "header">
   <h2>Business Login</h2>
</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<div class="input-group">
   <label>Business Name</label>
   <input type="text" name="busname">
</div>
<div class="input-group">
   <label>Password</label>
   <input type="password" name="password">
</div>
<div class="input-group">
   <button type="submit" class="btn" name="login_bsn">Submit</button>
</div>
   <p>
  		New Buisiness? <a href="buisinessRegister.php">Register your Business</a>
  	</p>
</form>
</body>
</html> 