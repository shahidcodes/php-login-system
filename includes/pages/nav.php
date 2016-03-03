<!-- Navigation -->
	<div class="col-md-4">
		<ul class="list-unstyled">
			<?php $user = new User(); if($user->isLogged()){
				echo "<p><b> Welcome: ",escape($user->data()->username), "</b></p>";
				//if logged in
			?>

			<li><a href="index.php">Home</a></li>
			<li><a href="logout.php">Logout</a></li>
			<li><a href="update.php">Update Name</a></li>
			<li><a href="profile.php?name=<?=escape($user->data()->username);?>">Profile</a></li>
			<li><a href="changepassword.php">Change Password</a></li>
			<?php }else{ //if doesnt logged in?>
			<li><a href="index.php">Home</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="register.php">Register</a></li>
			<?php } ?>
		</ul>
	</div>