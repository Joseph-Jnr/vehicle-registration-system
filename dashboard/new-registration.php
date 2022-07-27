<?php
session_start();
if (!isset($_SESSION["mv_firstname"])) {
	header("Location: ../index.php");
	exit();
}
$firstname = $_SESSION["mv_firstname"];
$lastname = $_SESSION["mv_lastname"];

include "includes/config.php";



// Define variables and initialize with empty values
$vid = $state = $brand = $model = $year = $chasis = $condition = $lga = "";
$vid_err = $state_err = $brand_err = $model_err = $year_err = $chasis_err = $condition_err = $lga_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {



	// Validate vid
	$input_vid = trim($_POST["vid"]);
	$vid = $input_vid;


	// Validate state
	$input_state = trim($_POST["state"]);
	if (empty($input_state)) {
		$state_err = "<p style='color:brown'>This field is compulsory.</p>";
	} else {
		$state = $input_state;
	}

	// Validate brand
	$input_brand = trim($_POST["brand"]);
	if (empty($input_brand)) {
		$brand_err = "<p style='color:brown'>This field is compulsory.</p>";
	} else {
		$brand = $input_brand;
	}

	// Validate model
	$input_model = trim($_POST["model"]);
	if (empty($input_model)) {
		$model_err = "<p style='color:brown'>This field is compulsory.</p>";
	} else {
		$model = $input_model;
	}

	// Validate year
	$input_year = trim($_POST["year"]);
	if (empty($input_year)) {
		$year_err = "<p style='color:brown'>This field is compulsory.</p>";
	} else {
		$year = $input_year;
	}

	// Validate chasis
	$input_chasis = trim($_POST["chasis"]);
	if (empty($input_chasis)) {
		$chasis_err = "<p style='color:brown'>This field is compulsory.</p>";
	} else {
		$chasis = $input_chasis;
	}

	// Validate condition
	$input_condition = trim($_POST["condition"]);
	if (empty($input_condition)) {
		$condition_err = "<p style='color:brown'>This field is compulsory.</p>";
	} else {
		$condition = $input_condition;
	}

	// Validate lga
	$input_lga = trim($_POST["lga"]);
	if (empty($input_lga)) {
		$lga_err = "<p style='color:brown'>This field is compulsory.</p>";
	} else {
		$lga = $input_lga;
	}

	// Check input errors before inserting in database
	if (empty($vid_err) && empty($state_err) && empty($brand_err) && empty($model_err) && empty($year_err) && empty($chasis_err) && empty($condition_err) && empty($lga_err)) {

		// Prepare an insert statement
		function random_alphabets($length_of_alphabet)
		{
			//String of all alphanumeric character
			$str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

			//Shuffle the $str_result and returns substring of specified length
			return substr(
				str_shuffle($str_result),
				0,
				$length_of_alphabet
			);
		}
		$part1 = random_alphabets(3);
		$part3 = random_alphabets(2);

		function random_number($length_of_number)
		{
			//String of all alphanumeric character
			$str_result = '0123456789';

			//Shuffle the $str_result and returns substring of specified length
			return substr(
				str_shuffle($str_result),
				0,
				$length_of_number
			);
		}
		$part2 = random_number(3);

		$plate_no = "$part1 - $part2$part3";

		$date = date('Y-m-d H:i:s');
		$owner = "" . $firstname . " " . $lastname . "";

		$sql = "INSERT INTO registrations (registration_id, owner, car_brand, car_model, car_year, plate_number, chasis_no, car_condition, local_govt, state_allocated, status, date) VALUES ('$vid', '$owner', '$brand', '$model', '$year', '$plate_no', '$chasis', '$condition', '$lga', '$state', 'Processing', '$date')";

		if ($stmt = mysqli_prepare($link, $sql)) {
			// Bind variables to the prepared statement as parameters

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Records created successfully. Redirect to landing page

				header("location: ../dashboard/?registration_complete");
				exit();
			} else {
				echo "
				<div class='col-md-12 text-center'>
				<p style='background:red; padding:20px; border:4px solid red; border-radius:4px; color:#fff; font-weight:bold;margin-bottom:0px;'>
				<i class='fa fa-warning'></i> Something went wrong! Please try again later.
				</p>
				</div>";
			}
		}

		// Close statement
		mysqli_stmt_close($stmt);
	}

	// Close connection
	mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../assets/img/logo.png" />

	<title>My Vehicle | New Registration</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="css/sweetalert.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="../dashboard/">
					<img src="../assets/img/logo.png" width="50px" height="auto" alt=""><span class="align-middle">My Vehicle</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Actions
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../dashboard/">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="vehicles.php">
							<i class="align-middle" data-feather="truck"></i> <span class="align-middle">My vehicles</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link track" href="#">
							<i class="align-middle" data-feather="navigation"></i> <span class="align-middle">Track my car</span>
						</a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="new-registration.php">
							<i class="align-middle" data-feather="link-2"></i> <span class="align-middle">Link vehicles</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">2</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									2 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Account created</div>
												<div class="text-muted small mt-1">Your account was created successfully.</div>
												<div class="text-muted small mt-1">3s ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login detected</div>
												<div class="text-muted small mt-1">A device just access your account. Please confirm if this was you.</div>
												<div class="text-muted small mt-1">2m ago</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="user"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="img/avatars/2.png" class="avatar img-fluid rounded me-1" alt="avatar" /> <span class="text-dark"><?php echo $firstname; ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="includes/logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="registration-form">
						<div class="card p-5">
							<div class="form-header text-center">
								<h2>Register a new vehicle</h2>
								<small>Please fill the form below</small>
							</div>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mt-5">
								<div class="row">
									<div class="mb-3 col-md-6 <?php echo (!empty($vid_err)) ? 'has-error' : ''; ?>">
										<label class="form-label">VID</label>
										<input class="form-control form-control-lg" type="text" value="<?php
																										function random_strings($length_of_string)
																										{
																											//String of all alphanumeric character
																											$str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

																											//Shuffle the $str_result and returns substring of specified length
																											return substr(
																												str_shuffle($str_result),
																												0,
																												$length_of_string
																											);
																										}
																										$vid = random_strings(11);
																										echo "$vid";
																										?>" disabled />
										<input type="text" name="vid" value="<?php echo $vid; ?>" hidden>
										<span class="help-block"><?php echo $vid_err; ?></span>
									</div>
									<div class="mb-3 col-md-6 <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
										<label class="form-label">State of collection</label>
										<input class="form-control form-control-lg" type="text" name="state" value="<?php echo $state; ?>" />
										<span class="help-block"><?php echo $state_err; ?></span>
									</div>
								</div>
								<div class="row">
									<div class="mb-3 col-md-4 <?php echo (!empty($brand_err)) ? 'has-error' : ''; ?>">
										<label class="form-label">Brand</label>
										<input class="form-control form-control-lg" type="text" name="brand" value="<?php echo $brand; ?>" placeholder="eg. Toyota" />
										<span class="help-block"><?php echo $brand_err; ?></span>
									</div>
									<div class="mb-3 col-md-4 <?php echo (!empty($model_err)) ? 'has-error' : ''; ?>">
										<label class="form-label">Car model</label>
										<input class="form-control form-control-lg" type="text" name="model" value="<?php echo $model; ?>" placeholder="eg. Camry" />
										<span class="help-block"><?php echo $model_err; ?></span>
									</div>
									<div class="mb-3 col-md-4 <?php echo (!empty($year_err)) ? 'has-error' : ''; ?>">
										<label class="form-label">Year</label>
										<input class="form-control form-control-lg" type="tel" name="year" value="<?php echo $year; ?>" />
										<span class="help-block"><?php echo $year_err; ?></span>
									</div>
								</div>
								<div class="row">
									<div class="mb-3 col-md-6 <?php echo (!empty($chasis_err)) ? 'has-error' : ''; ?>">
										<label class="form-label">Chasis No.</label>
										<input class="form-control form-control-lg" type="text" name="chasis" value="<?php echo "$chasis"; ?>" />
										<span class="help-block"><?php echo $chasis_err; ?></span>
									</div>
									<div class="mb-3 col-md-6 <?php echo (!empty($condition_err)) ? 'has-error' : ''; ?>">
										<label class="form-label">Condition</label>
										<select name="condition" class="form-control form-control-lg" id="">
											<option value="<?php echo $condition; ?>"><?php echo $condition; ?></option>
											<option value="" disabled>-- Select an option --</option>
											<option value="New">New</option>
											<option value="Used">Used</option>
										</select>
										<span class="help-block"><?php echo $condition_err; ?></span>
									</div>
								</div>
								<div class="mb-3 <?php echo (!empty($lga_err)) ? 'has-error' : ''; ?>">
									<label class="form-label">Local government area</label>
									<input class="form-control form-control-lg" type="text" name="lga" value="<?php echo "$lga"; ?>" />
									<span class="help-block"><?php echo $lga_err; ?></span>
								</div>

								<div class="form-footer d-flex justify-content-between">
									<a href="../dashboard/" class="btn btn-lg btn-secondary">Back</a>
									<button type="submit" class="btn btn-lg btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>

	<script src="js/jquery-1.12.4.min.js"></script>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/swal.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>