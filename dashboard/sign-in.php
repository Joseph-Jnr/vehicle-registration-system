<?php
session_start();
// Include config file
include "includes/config.php";

// Define variables and initialize with empty values
$email = $pwd =  "";
$email_err = $pwd_err = "";


// Processing form data when form is submitted
if (($_SERVER["REQUEST_METHOD"] == "POST")) {

	if (isset($_POST["submit_login"])) {

		// Validate Name
		$input_email = trim($_POST["email"]);
		if (empty($input_email)) {
			$email_err = "<p style='color:brown'>This field is compulsory.</p>";
		} else {
			$sql = "SELECT * FROM users WHERE email='$input_email'";
			$result = mysqli_query($link, $sql);
			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck < 1) {
				$email_err = "<p style='color:brown'>Invalid credentials.</p>";
			} else {
				$email = $input_email;
			}
		}

		// Validate Password
		$input_pwd = trim($_POST["password"]);
		if (empty($input_pwd)) {
			$pwd_err = "<p style='color:brown'>Enter password.</p>";
		} else {
			$pwd = $input_pwd;
		}

		// Check input errors before inserting in database
		if (empty($email_err) && empty($pwd_err)) {

			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

				$hashedPwdCheck = password_verify($pwd, $row['password']);
				if ($hashedPwdCheck == false) {
					$pwd_error = "<i class='text-danger fa fa-exclamation-circle'></i>";
					$pwd_err = "<p style='color:brown'>Incorrect password</p>";
				} elseif ($hashedPwdCheck == true) {
					$_SESSION['mv_firstname'] = $row['firstname'];
					$_SESSION['mv_lastname'] = $row['lastname'];
					$_SESSION['mv_state_of_residence'] = $row['state_of_residence'];
					$_SESSION['expire'] = time() + (45 * 60);

					$result = mysqli_query($link, $sql);

					header("Location: ../dashboard/?success");
					exit();
				}
			} else {
				// URL doesn't contain valid id. Redirect to error page
				header("Location: sign-in.php?failed");
				exit();
			}

			// Close statement
			mysqli_stmt_close($stmt);
		} else {
			$login_error = "<i class='text-danger fa fa-exclamation-circle'></i>";
		}

		// Close connection
		mysqli_close($link);
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/logo.png" />

	<title>Sign In | My Vehicle</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="text-center">
							<a href="../index.php"><img src="img/icons/logo.png" width="100" height="auto" alt="logo"></a>
						</div>
						<div class="text-center mt-4">
							<h1 class="h2">Welcome back</h1>
							<p class="lead">
								Login to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<?php
								if (isset($_GET['account_created'])) {
									echo "
											<div class='signup-alert text-success d-flex justify-content-center'>
												<span class='text-center'>Signup successful <i data-feather='check'></i></span>
											</div>
										";
								}
								?>
								<div class="m-sm-4">
									<div class="text-center">
										<img src="img/avatars/2.png" alt="avatar" class="img-fluid rounded-circle" width="90" height="auto" />
									</div>
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
										<div class="mb-3 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value="<?php echo $email; ?>" />
											<span class="help-block"><?php echo $email_err; ?></span>
										</div>
										<div class="mb-3 <?php echo (!empty($pwd_err)) ? 'has-error' : ''; ?>">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" value="<?php echo $pwd; ?>" />
											<span class="help-block"><?php echo $pwd_err; ?></span>
										</div>
										<small>
											<a href="#">Forgot password?</a>
										</small>
										<div class="text-center mt-3">
											<button type="submit" name="submit_login" class="btn btn-lg btn-primary">Login</button><br><br>
											<span class="mt-3">Do not have an account yet? <a href="sign-up.php">Create an account</a></span>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/jquery-1.12.4.min.js"></script>
	<script src="js/app.js"></script>

</body>

</html>