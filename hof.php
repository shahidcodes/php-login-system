<!DOCTYPE html>
<html>
<head>
	<title>Hall Of Fame</title>
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
		<h2>Welcome :)</h2>
		<p>My Leet Friends Who Helped me to Find my mistakes :D</p>
		</div>
	</div>
	<!-- Content -->
	<div class="col-md-8">
		<content>
		<p><kbd>List :</kbd></p>
        <table class="table">
        <tr>
			<td><b>Patel Jay (<a href="https://www.facebook.com/jaypatel9717">FB</a>)</b></td>
            <td><kbd>#Level2: Stored Xss [Fixed]</kbd></td>
        </tr>
        <tr>
            <td><b>Manish Agrawal (<a href="https://www.facebook.com/manishbitr">FB</a>)</b></td>
            <td><kbd>#Level1</kbd></td>
        </tr>
         <tr>
			<td><b>Nikhil Mittal (<a href="https://www.facebook.com/nikhil.mittal.549436">FB</a>)</b></td>
            <td><kbd>ClickJacking (UI-Redress Attack) [Fixed]</kbd></td>
        </tr>
		</table>
		</content>
	</div>
	<!-- Footer -->
	<?php @include 'includes/pages/footer.php' ?>
</div>
</body>
</html>