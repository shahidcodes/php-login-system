<?php

require_once 'core/init.php';

if (Input::exists()) {
  if (Token::check(Input::get('token')) && Captcha::check(Input::get('captcha'))) { //checking if token exists
  	$validate = new Validate();
  	$validation = $validate->check($_POST, array(
  		'username' => array('required'	=> true),
      'password' => array('required'=> true,'min'=> '6')
  		));
  	if ($validation->passed()) { //method chaining
  		$user = new User();
      $remember = (Input::get('remember') === 'on') ? true : false;
  		$login = $user->login(Input::get('username'), Input::get('password'), $remember);
  		if ($login) {
  			Redirect::to('index.php');
  		}
    }else{
  		Session::flash('le', $validation->errors());
  	}
  }else if(Captcha::error()){
  	Session::flash('errorCap', 'Captcha Mismatch');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login :)</title>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
</head>
<body>
<div class="container">
  <!-- header section -->
  <div class="col-md-12">
    <div class="jumbotron">
    <h1>Login</h1>
    <small>Login to continue using !</small>
    </div>
  </div>
  <!-- Navigation -->
  <div class="col-md-4">
    <ul class="list-unstyled">
      <?php $user = new User(); if($user->isLogged()){
        echo "<p><b> Welcome: ",escape($user->data()->username), "</b></p><code>You are already Logged in</code>";
      ?>
      <li><a href="index.php">Home</a></li>
      <li><a href="logout.php">Logout</a></li>
      </ul>
  </div>
      <?php }else{?>
      <li><a href="index.php">Home</a></li>
      <li><a href="register.php">Register</a></li>
    </ul>
  </div>
  <div class="col-md-8">
<?php if (Session::exists('le')) { foreach(Session::flash('le') as $error){ echo "<li class=\"list-unstyled\">",$error,"</li>";}} ?>
<form action="" method="POST">
<div class="form-group">
	<label for="username">Username:</label>
	<input class="form-control" type="text" name="username">
</div>
<div class="form-group">
	<label for="password">Password:</label>
	<input class="form-control" type="password" name="password">
</div>
<?php Session::put('secure', rand(1000, 9999)); ?>
    <div class="form-group">
    <label for="captcha">Captcha: </label>
    <img src="cap.php"><?php echo Session::flash('errorCap'); ?>
    <input type="text" name="captcha" class="form-control" value="">
    </div>
	<input type="hidden" name="token" value="<?=Token::generate() ?>">
  <input type="checkbox" name="remember">Remember Me<br>
	<input type="submit" value="Log in">
</form>
</div>
<?php  };
@include 'includes/pages/footer.php'; ?>
</div>
</body>
</html>  