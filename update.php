<?php
require_once 'core/init.php';
$user = new User();
if ($user->isLogged()) {
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'name' => array(
					'required' => true,
					'min' => '2',
					'max' => '50'
					)
				));
			if ($validation->passed()) {
				try {
				$user->update(array(
					'name' => Input::get('name')
					));
				Session::flash('home', 'Your Name Has Been Update');
				Redirect::to('index.php');
				} catch (Exception $e) {
					die($e->getMessage());
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
		<h3>Update Your Name: </h3>
		</div>
	</div>
		<?php require 'includes/pages/nav.php'; ?>
	<div class="col-md-8">
		<form method="POST" action="">
			<div class="form-group">
				<label for="name">Full Name</label>
				<input class="form-control" name="name" type="text" value="<?=@escape($user->data()->name)?>" />
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
