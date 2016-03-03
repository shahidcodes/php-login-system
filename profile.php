<?php
require_once 'core/init.php';

if (!$username = Input::get('name')) {
	Redirect::to('index.php');
}else if($username){
	$user = new User();
	if($user->data()->username == $username){
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
		<h2>Profile Of User: <?php echo escape($user->data()->username) ?></h2>
		</div>
	</div>
	<?php require 'includes/pages/nav.php'; ?>
	<!-- content section -->
	<div class="col-md-8">
		<table class="table">
			<thead>Profile Of User: <?php echo escape($user->data()->username) ?></thead>
			<tr>
				<td>Name: </td>
				<td><?php echo escape($user->data()->name) ?></td>
			</tr>
			<tr>
				<td>Group: </td>
				<td><?php echo escape($user->data()->group) ?></td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>

<?php
}else{
	Redirect::to(404);
}
} else {
	Redirect::to(404);
}
?>