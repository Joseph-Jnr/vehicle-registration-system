<?php
session_start();
// Include config file
include "includes/config.php";

// Define variables and initialize with empty values
$fname = $lname = $email = $dob = $sor = $phone = $address = $password =  "";
$fname_err = $lname_err = $email_err = $dob_err = $sor_err = $phone_err = $address_err = $password_err = "";


// Processing form data when form is submitted
if (($_SERVER["REQUEST_METHOD"] == "POST")) {


	//############# Sign up Form ################

	if (isset($_POST["submit_signup"])) {


		// Validate firstname
		$input_fname = trim($_POST["firstname"]);
		if (empty($input_fname)) {
			$fname_err = "<p style='color:brown'>This field is compulsory.</p>";
		} else {
			$fname = $input_fname;
		}

		// Validate lastname
		$input_lname = trim($_POST["lastname"]);
		if (empty($input_lname)) {
			$lname_err = "<p style='color:brown'>This field is compulsory.</p>";
		} else {
			$lname = $input_lname;
		}

		// Validate email
		$input_email = trim($_POST["email"]);
		if (empty($input_email)) {
			$email_err = "<p style='color:brown'>This field is compulsory.</p>";
		} else {
			$sql = "SELECT * FROM users WHERE email='$input_email'";
			$result = mysqli_query($link, $sql);
			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck > 0) {
				$email_err = "<p style='color:brown'>An account already exists with this email.</p>";
			} else {
				$email = $input_email;
			}
		}

		// Validate date of birth
		$input_dob = trim($_POST["dob"]);
		if (empty($input_dob)) {
			$dob_err = "<p style='color:brown'>This field is compulsory.</p>";
		} else {
			$dob = $input_dob;
		}

		// Validate state_of_residence
		$input_sor = trim($_POST["sor"]);
		if (empty($input_sor)) {
			$sor_err = "<p style='color:brown'>This field is compulsory.</p>";
		} else {
			$sor = $input_sor;
		}

		// Validate phone
		$input_phone = trim($_POST["phone"]);
		if (empty($input_phone)) {
			$phone_err = "<p style='color:brown'>This field is compulsory.</p>";
		} else {
			$phone = $input_phone;
		}

		// Validate address
		$input_address = trim($_POST["address"]);
		if (empty($input_address)) {
			$address_err = "<p style='color:brown'>This field is compulsory.</p>";
		} else {
			$address = $input_address;
		}

		// Validate password
		$input_password = trim($_POST["password"]);
		if (empty($input_password)) {
			$password_err = "<p style='color:brown'>Please choose a password.</p>";
		} else {
			//Hashing the password
			$hashedpwd = password_hash($input_password, PASSWORD_DEFAULT);
			$password = $hashedpwd;
		}




		// Check input errors before inserting in database
		if (empty($fname_err) && empty($lname_err) && empty($email_err) && empty($dob_err) && empty($sor_err) && empty($phone_err) && empty($address_err) && empty($password_err)) {

			// Prepare an insert statement

			$date = date('Y-m-d');
			$sql = "INSERT INTO users (firstname, lastname, email, date_of_birth, state_of_residence, phone, address, password, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, '$date')";

			if ($stmt = mysqli_prepare($link, $sql)) {
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ssssssss", $param_fname, $param_lname, $param_email, $param_dob, $param_sor, $param_phone, $param_address, $param_password);

				// Set parameters
				$param_fname = $fname;
				$param_lname = $lname;
				$param_email = $email;
				$param_dob = $dob;
				$param_sor = $sor;
				$param_phone = $phone;
				$param_address = $address;
				$param_password = $password;

				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					// Records created successfully. Redirect to landing page
					header("location: sign-in.php?account_created");
					exit();
				} else {
					echo "
	  <div class='col-md-12 text-center'>
	  <p style='background:red; padding:20px; border:4px solid red; border-radius:4px; color:#fff; font-weight:bold;margin-bottom:4px;margin-top:-60px;'>
	  <i class='fa fa-warning'></i> Something went wrong! Please try again later.
	  </p>
	  </div>";
				}
			}

			// Close statement
			mysqli_stmt_close($stmt);
		} else {
			$error = "<i class='text-danger fa fa-exclamation-circle'></i>";
			//header("location: ?error");
			//exit();
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

	<title>Sign Up | My Vehicle</title>

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
							<h1 class="h2">Create an account</h1>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
										<div class="row">
											<div class="mb-3 col-md-6 <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
												<label class="form-label">First Name</label>
												<input class="form-control form-control-lg" type="text" name="firstname" value="<?php echo $fname; ?>" />
												<span class="help-block"><?php echo $fname_err; ?></span>
											</div>
											<div class="mb-3 col-md-6 <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
												<label class="form-label">Last Name</label>
												<input class="form-control form-control-lg" type="text" name="lastname" value="<?php echo $lname; ?>" />
												<span class="help-block"><?php echo $lname_err; ?></span>
											</div>
										</div>

										<div class="mb-3 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value="<?php echo $email; ?>" />
											<span class="help-block"><?php echo $email_err; ?></span>
										</div>
										<div class="row">
											<div class="mb-3 col-md-6 <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
												<label class="form-label">Date of birth</label>
												<input class="form-control form-control-lg" type="date" name="dob" value="<?php echo $dob; ?>" />
												<span class="help-block"><?php echo $dob_err; ?></span>
											</div>
											<div class="mb-3 col-md-6 <?php echo (!empty($sor_err)) ? 'has-error' : ''; ?>">
												<label class="form-label">State of residence</label>
												<input class="form-control form-control-lg" type="text" name="sor" value="<?php echo $sor; ?>" />
												<span class="help-block"><?php echo $sor_err; ?></span>
											</div>
										</div>
										<div class="mb-3 <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
											<label class="form-label">Phone Number</label>
											<input class="form-control form-control-lg" type="tel" name="phone" value="<?php echo $phone; ?>" />
											<span class="help-block"><?php echo $phone_err; ?></span>
										</div>
										<div class="mb-3 <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
											<label class="form-label">Address</label>
											<input class="form-control form-control-lg" type="text" name="address" value="<?php echo $address; ?>" />
											<span class="help-block"><?php echo $address_err; ?></span>
										</div>
										<div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
											<label class="form-label">Choose a password</label>
											<input class="form-control form-control-lg" type="password" name="password" value="<?php echo $password; ?>" />
											<span class="help-block"><?php echo $password_err; ?></span>
										</div>
										<div class="text-center mt-3">
											<button type="submit" name="submit_signup" class="btn btn-lg btn-primary">Sign up</button><br><br>
											<span class="mt-3">I already have an account | <a href="sign-in.php">Login</a></span>
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

	<script src="js/app.js"></script>

</body>

</html>