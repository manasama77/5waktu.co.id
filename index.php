<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="adampm">

	<title>Lima Waktu Logistic</title>

	<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
	<link rel="stylesheet" href="css/new_login.css">
</head>

<body>
	<div class="login-container">
		<div class="login-card">
			<div class="login-header">
				<div class="logo">
					<div class="logo-square"></div>
				</div>
				<h2>5Waktu<br />Logistic</h2>
				<p>Sign In</p>
			</div>

			<!-- show error when $_SESSION['auth'] == "0" -->
			<?php
			if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}
			if (isset($_SESSION['auth']) && $_SESSION['auth'] === "0") {
				// forgot to unset session after showing the message
				unset($_SESSION['auth']);
			?>
				<div class="form-error-message" style="color:#d32f2f; background:#fff3f3; border:2px solid #d32f2f; padding:12px; margin-bottom:16px; text-align:center; font-weight:600;">Username / Password Salah</div>
			<?php
			}
			?>


			<form class="form-signin" action="process_login.php" method="post">
				<div class="form-group">
					<label for="username" class="form-label">Username</label>
					<div class="input-wrapper">
						<input type="text" id="username" name="username" required autocomplete="username" autofocus>
					</div>
					<span class="error-message" id="usernameError"></span>
				</div>

				<div class="form-group">
					<label for="password" class="form-label">Password</label>
					<div class="input-wrapper password-wrapper">
						<input type="password" id="password" name="password" required autocomplete="current-password">
						<button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
							<span class="toggle-text">SHOW</span>
						</button>
					</div>
					<span class="error-message" id="passwordError"></span>
				</div>

				<button type="submit" class="login-btn">
					<span class="btn-text">SIGN IN</span>
					<div class="btn-loader">
						<div class="loader-bar"></div>
						<div class="loader-bar"></div>
						<div class="loader-bar"></div>
					</div>
				</button>
			</form>

			<div class="success-message" id="successMessage">
				<div class="success-icon">✓</div>
				<h3>Success</h3>
				<p>Redirecting...</p>
			</div>
		</div>
	</div>

	<footer style="position: fixed; bottom: 0; left: 0; right: 0; text-align: center; padding: 16px; background: transparent; color: #6b7280; font-size: 12px; z-index: 1000;">
		&copy; 2017 - 2025 Lima Waktu Logistic. Version 1.1.0 | Created by <a href="https://www.linkedin.com/in/adampm/" style="color: #6b7280; text-decoration: none; font-weight: 600;" target="_blank" rel="noopener noreferrer">adam pm</a>
	</footer>

	<script src="./js/new_login.js"></script>
</body>

</html>