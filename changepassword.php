<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLogged()) {
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'oldPassword' => array(
					'required' => true,
					'min' => '6'
					),
				'newPassword' => array(
					'required' => true,
					'min' => '6'
					),
				'newPasswordAgain' => array(
					'required' => true,
					'min' => '6',
					'matched' => 'newPassword'
					)
				));
			if ($validation->passed()) {
				//generate hash from given pass
				$hash = Hash::make(Input::get('oldPassword'), $user->data()->salt);
				$checkHash = $user->data()->password;

				//match password from db
				if ($hash == $checkHash) {
					//update password if matches
					$salt = Hash::salt(32);
					$hash = Hash::make(Input::get('newPassword'), $salt);
					try {
						$user->update(array(
							'password' => $hash,
							'salt' => $salt
							));
						Session::flash('home', 'Your Password Has Been Updated!');
						Redirect::to('index.php');
					} catch (Exception $e) {
						die($e->getMessage());
					}
					
				}

			}else{
				echo "<div class=\"danger\"><ul>";
				foreach ($validation->errors() as $error) {
					echo "<li class=list-group-item>",$error,"</li>";
				}
				echo "</ul></div>";
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome :)</title>
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
		</div>
	</div>
	<?php require 'includes/pages/nav.php';  ?>
	<div class="col-md-8">
	<pre>Change Your Password Here</pre>
		<form method="POST" action="">
			<div class="form-group">
				<label for="oldPassword">Old Password :</label><br />
				<input class="form-control" name="oldPassword" type="password" value="" />
			</div>
			<div class="form-group">
				<label for="newPassword">New Password :</label><br />
				<input class="form-control" name="newPassword" type="password" value="" />
			</div>
			<div class="form-group">
				<label for="newPasswordAgain">New Password Again :</label><br />
				<input class="form-control" name="newPasswordAgain" type="password" value="" />
			</div>
			<input type="hidden" name="token" value="<?=Token::generate() ?>">
			<input class="btn btn-default" type="submit" name="submit">

		</form>
	</div>
</div>
</body>
</html>
<?php
}else{
	Redirect::to(404);
} 