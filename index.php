<?php
require_once 'core/init.php';

?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Login Registration Script | #1337kh4n Blog</title>
    <meta name="description" content="A Login Registration System Script Written In OOP From Scratch By Shahid Khan">
    <meta name="keywords" content="A Login Registration System Script Written In OOP From Scratch By Shahid khan">
    <meta name="author" content="Shahid Khan">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<style type="text/css">
	.col-md-8 {
		border-left: 1px solid grey;
	}
	.col-md-4{
		border-left: 2px solid grey;
	}
	</style>
</head>
<body>
<div class="container">
	<!-- header section -->
	<div class="col-md-12">
		<div class="jumbotron">
		<h2>Welcome :)</h1>
		<p>You can Login and Register Here</p>
		</div>
	</div>
	<!-- Notification -->
	<div class="col-md-12">
		<?php echo Session::flash('home'); ?>
	</div>
	<?php require 'includes/pages/nav.php'; ?>
	<!-- Content -->
	<div class="col-md-8">
		<content>
		<a class="btn btn-primary" href="login.php">Login</a>
		<a class="btn btn-success" href="register.php">Register</a>
		</content>
	</div>
	<!-- Footer -->
	<?php @include 'includes/pages/footer.php' ?>
</div>
</body>
</html>
