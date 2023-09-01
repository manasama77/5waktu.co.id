<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head Start -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
	<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
	<title>Lima Waktu Logistic</title>
	<meta name="author" content="@manasama77">
	<!-- <script src="js/jquery-3.1.0.min.js"></script> -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/cover.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet" type="text/css">
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>

</head>

<body>

	<div class="site-wrapper">
		<div class="site-wrapper-inner">
			<div class="title-container">

				<div class="inner cover col-xs-8">
					<h1 class="cover-heading">Lima Waktu Logistic Application</h1>
					<p class="lead">Application for support your expedition.</p>
				</div>

				<div class="form-login col-xs-4">
					<form class="form-signin" action="process_login.php" method="post">
						<h2 class="form-signin-heading">Please sign in</h2>
						<label for="username" class="sr-only">Username</label>
						<input name="username" id="username" class="form-control" placeholder="Username" required autofocus type="text">
						<label for="password" class="sr-only">Password</label>
						<input name="password" id="password" class="form-control" placeholder="Password" required type="password">
						<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
					</form>
				</div>

			</div>

			<div class="cover-container">

				<div class="mastfoot">
					<div class="inner">
						<p> &copy; 2017 - 2021 Lima Waktu Logistic. Version 1.1.0 | Created by <a href="https://twitter.com/adampm">@adampm</a>.</p>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>

</html>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/sweetalert2@10.js"></script>

<script>
	$(document).ready(function() {
		if (<?php if (isset($_SESSION['auth'])) {
				echo $_SESSION['auth'];
			} else {
				echo "";
			} ?> == 0) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				text: 'Username / Password Salah',
			});
		}
	});
</script>