<?php
session_start();
if (!isset($_SESSION["mv_firstname"])) {
	header("Location: ../index.php");
	exit();
}
$firstname = $_SESSION["mv_firstname"];
$lastname = $_SESSION["mv_lastname"];

include "includes/config.php";

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../assets/img/logo.png" />

	<title>My Vehicle | My Vehicles</title>

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

					<li class="sidebar-item active">
						<a class="sidebar-link" href="vehicles.php">
							<i class="align-middle" data-feather="truck"></i> <span class="align-middle">My vehicles</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link track" href="#">
							<i class="align-middle" data-feather="navigation"></i> <span class="align-middle">Track my car</span>
						</a>
					</li>

					<li class="sidebar-item">
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
							<div class="form-header">
								<h2>My Vehicles</h2>
							</div>
							<hr>
							<div class="vehicles-section">
								<div class="row">
									<?php
									include "includes/config.php";
									$sql2 = "SELECT * FROM registrations WHERE owner='" . $firstname . " " . $lastname . "'";
									$result = mysqli_query($link, $sql2);
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_array($result)) {
											$vid = $row["registration_id"];
											$date = $row["date"];
											$date_full = strftime('%b %d, %Y', strtotime($date));
											$state = $row["state_allocated"];
											$plate_no = $row["plate_number"];
											$car_brand = $row["car_brand"];
											$car_model = $row["car_model"];
											$car_year = $row["car_year"];
											echo "
												<div class='single-vehicle col-md-4'>
													<div class='header d-flex justify-content-between'>
														<div class='vid'>
															<small>$vid</small>
														</div>
														<div class='date'>
															<small>$date_full</small>
														</div>
													</div>
													<div class='body'>
														<div class='plate_no'>
															<h4 class='text-uppercase'>$state</h4>
															<h1>$plate_no</h1>
														</div>
													</div>
													<div class='footer text-center'>
														<span>$car_brand $car_model $car_year</span>
													</div>
												</div>
											";
										}
									} else {
										echo "No record";
									}

									// Close connection
									mysqli_close($link);
									?>
								</div>
							</div>
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

</body>

</html>