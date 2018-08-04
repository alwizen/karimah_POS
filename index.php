<?php
session_start();
if( isset($_SESSION['akses']) )
{
	header('location:'.$_SESSION['akses']);
	exit();
}
$error = '';
if( isset($_SESSION['error']) ) {
 	$error = $_SESSION['error'];
 	unset($_SESSION['error']);
} ?>
<?php echo $error;?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Karimah Hijab Login</title>
	  <link rel="icon" href="img/logo1.png">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
			<div class="container main-section">
				<div class="row">
					<div class="col-md-12 text-center user-login-header">
						<!-- <h1>Selamat Datang, </h1> -->
						<!-- <p>Made with <span>&hearts; </span></p> -->
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 login-image-main text-center">
						<div class="row">
							<!-- <h2 style="text-shadow: black 0.3em 0.3em 0.3em;">Karimah Hijab Store</h2><br> -->
							<img src="img/logo.png" style="width: 300px" alt="">
							<div class="col-md-12 col-sm-12 col-xs-12 user-login-box">
								<form action="proseslogin.php" method="POST">
								<div class="form-group">
							  		<input type="text" class="form-control" name="username" placeholder="Username" id="usr">
								</div>
								<div class="form-group">
							  		<input type="password" name="password" class="form-control" placeholder="Password" id="pwd">
								</div>

								<!-- <a href="#" class="btn btn-defualt">Login</a> -->
								<input type="submit" name="login" class="btn btn-danger btn-block" value="Login" /><br>

								</form>
							</div>
						</div>
					</div>
				</div><br><br><br>
				<p style="text-align: center; color: #fff;">Made with <span class="glyphicon glyphicon-heart" style="color:red;"></span><a href="index.php" ><strong> Karimah Hijab Store</strong></a></p>
</body>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</html>



