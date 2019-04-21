<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Login</title>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">

	<!-- Penghubung dengan file CSS bootstrap 4.0 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<!-- Penghubung dengan file CSS override -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
	<!-- Import library jquery -->
	<script
	src="https://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
	<!-- Penghubung dengan file JS bootstrap 4.0 -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>


</head>
<body>

	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="login-card">

				<!-- Logo -->
				<div class="d-flex justify-content-center">
					<div class="logo-container circle">
						<img id="logo" src="<?php echo base_url(); ?>assets/img/logo-gpt-petra.png" alt="logo gereja petra">
					</div>
				</div>
				<!-- Logo -->

				<!-- Form -->
				<div class="d-flex justify-content-center">
					<form action="<?php echo base_url('Start/login'); ?>" method="post" class="login-form">						
						<div class="form-group">
							<label class="sr-only" for="username">Username</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text">#</span>
								</div>
								<input class="form-control" type="text" name="username" id="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label class="sr-only" for="password">Password</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text">#</span>
								</div>
								<input class="form-control" type="password" name="password" id="password" placeholder="Password">
							</div>
						</div>
						<div class="d-flex justify-content-center mt-3 login-btn-container">
							<button type="submit" class="btn btn-primary">Login</button>   
						</div>
					</form>
				</div>
				<!-- Form -->

			</div>
		</div>
	</div>

</body>
</html>