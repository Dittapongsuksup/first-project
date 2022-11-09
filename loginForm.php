<?php
session_start();
require_once 'config/connect.php';

if (isset($_POST['']))
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="css/styles.css" rel="stylesheet" />


</head>

<body style="background-color:RGB(0, 0, 0);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section" style="color: #FFFFFF;">Please enter your Student ID and Password.</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="fa fa-user-o"></span>
						</div>
						<h3 class="text-center mb-4">SIGN IN</h3>

						<form action="loginDB.php" class="login-form" method="POST">
							<?php if (isset($_SESSION['error'])) { ?>
								<div class="alert alert-danger" role="alert">
									<?php
									echo $_SESSION['error'];
									unset($_SESSION['error']);
									?>
								</div>
							<?php } ?>
							<?php if (isset($_SESSION['success'])) { ?>
								<div class="alert alert-danger" role="alert">
									<?php
									echo $_SESSION['success'];
									unset($_SESSION['success']);
									?>
								</div>
							<?php } ?>
							<div class="form-group">
								<label for="studentId" class="col-form-label">เลขประจำตัวนักศึกษา</label>
								<input type="studentId" class="form-control rounded-left" name="studentId" placeholder="Student ID" required>
							</div>
							<div class="form-group">
								<label for="password" class="col-form-label">รหัสผ่าน</label>
								<input type="password" class="form-control rounded-left" name="password" placeholder="Password" required>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="register.php">Signup</a>
								</div>
							</div>
							<div class="form-group d-md-flex">
								<button type="submit" class="btn btn-success rounded submit mx-auto p-2 mt-5" name="login">LOGIN</button>
								<button type="submit" class="btn btn-danger rounded submit mx-auto p-2 mt-5"><a href="index.php">CANCEL</a></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>