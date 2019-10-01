<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset='utf-8' />
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
<?php 
require_once 'core/init.php';
if (Input::exists()) {	//check if Get/Post isnt empty
	if (Token::check(Input::get('token')) && Captcha::check(Input::get('captcha'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required'	=> true,
				'min' 		=> '2',
				'max'		=> '20',
				'unique'	=> 'users'
				),
			'password' => array(
				'required'	=> true,
				'min'		=> '6'
				),
			'password-again' => array(
				'required'	=> true,
				'min'		=> '6',
				'matches'	=> 'password'
				),
			'name' => array(
				'required'	=> true,
				'max'		=> '50',
				'min'		=> '2'
				)
			));
		if ($validation->passed()) {
            //salt to be stored in db
			$salt = Hash::salt(32);
			try {
				$user = new User(); 
				$user->createUser(array( //fields array in User::createUser method
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt) ,
					'salt' => $salt ,
					'joined' => date('Y-m-d H:i:s'),
					'name' => Input::get('name'),
					'group' => 1
					));
				Session::flash('home', 'You have been registered. You can Login!');
				Redirect::to('index.php');
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}else{
			Session::flash('error', $validation->errors());
		}
	}else{
		if(Captcha::error()){
			Session::flash('errorCap', 'Captcha Mismatch');
		}
	}
}
?>
<div class="container">
<div class="jumbotron">
	<h2>Register As a New User</h2>
	<h4>Fill All Details Correctly</h4>
</div>
	<?php require 'includes/pages/nav.php'; ?>
<div class="register col-md-8">
<?php if (Session::exists('error')) { foreach(Session::flash('error') as $error){ echo $error,"<br>";}} ?>
	<form action="" method="POST">
		<div class="form-group">
		<label for="username">Username: </label>
		<input type="text" name="username" class="form-control" id="username" value="<?=@escape(Input::get('username'));?>">
		</div>
		<div class="form-group">
		<label for="password">Password:</label>
		<input type="password" class="form-control" name="password" id="password">
		</div>
		<div class="form-group">
		<label for="password-again">Type Password Again:</label>
		<input type="password" class="form-control" name="password-again" id="password-again" value="">
		</div>
		<div class="form-group">
		<label for="name">Name: </label>
		<input type="text" class="form-control" name="name" id="name" value="<?=@escape(Input::get('name'));?>">
		</div>
		<?php Session::put('secure', rand(1000, 9999)); ?>
		<div class="form-group">
		<label for="captcha">Captcha: </label>
		<img src="cap.php"><?php echo Session::flash('errorCap'); ?>
		<input type="text" name="captcha" class="form-control" value="">
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate() ?>">
		<input type="submit" class="btn btn-success" value="Register">
	</form>
</div>
<!-- Footer -->
<?php @include 'includes/pages/footer.php'; ?>
</div>
</body>
</html>
