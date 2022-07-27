<?php
session_start();
if (!isset($_SESSION["mv_firstname"])) {
	header("Location: ../index.php");
	exit();
}
$firstname = $_SESSION["mv_firstname"];
$lastname = $_SESSION["mv_lastname"];
$state_of_residence = $_SESSION["mv_state_of_residence"];

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

	<title>My Vehicle | Dashboard</title>

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

					<li class="sidebar-item active">
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

					<h1 class="h3 mb-3"><strong>Welcome,</strong> <?php echo $firstname; ?> 👋</h1>

					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body summary">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Registrations</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="file-text"></i>
														</div>
													</div>
												</div>
												<h4 class="mt-1 mb-3">
													<?php
													$sql = "SELECT count(id) AS total FROM registrations WHERE owner='" . $firstname . " " . $lastname . "' ";
													$result = mysqli_query($link, $sql);
													$values = mysqli_fetch_assoc($result);
													$num_rows = $values['total'];
													echo $num_rows;
													?>
												</h4>
											</div>
										</div>
										<div class="card">
											<div class="card-body summary">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Failed Verifications</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="alert-octagon"></i>
														</div>
													</div>
												</div>
												<h4 class="mt-1 mb-3">
													<?php
													$sql = "SELECT count(id) AS total FROM registrations WHERE owner='" . $firstname . " " . $lastname . "' && status='Failed' ";
													$result = mysqli_query($link, $sql);
													$values = mysqli_fetch_assoc($result);
													$num_rows = $values['total'];
													echo $num_rows;
													?>
												</h4>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body summary">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Vehicles</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="truck"></i>
														</div>
													</div>
												</div>
												<h4 class="mt-1 mb-3">
													<?php
													$sql = "SELECT count(id) AS total FROM registrations WHERE owner='" . $firstname . " " . $lastname . "' ";
													$result = mysqli_query($link, $sql);
													$values = mysqli_fetch_assoc($result);
													$num_rows = $values['total'];
													echo $num_rows;
													?>
												</h4>
											</div>
										</div>
										<div class="card">
											<div class="card-body summary">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Location</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="map-pin"></i>
														</div>
													</div>
												</div>
												<h4 class="mt-1 mb-3"><?php echo $state_of_residence; ?>, Nigeria</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-body py-3 vehicle-img">
									<div class="chart chart-sm">

									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row mb-5 mt-5">
						<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
							<div class="container">
								<div class="section-header">
									<h5>Quick Action</h5>
								</div>
								<hr class="hr">
								<div class="quick-actions mt-5 text-center">
									<div class="row">
										<div class="single-action col-4 col-md-4 col-lg-4">
											<a href="new-registration.php" class="d-flex justify-content-center">
												<div class="stat text-primary">
													<i class="align-center" data-feather="plus-square"></i>
												</div>
											</a><br>
											<a href="new-registration.php">
												<h5>New Registration</h5>
											</a>
										</div>
										<div class="single-action col-4 col-md-4 col-lg-4">
											<a href="new-registration.php" class="d-flex justify-content-center">
												<div class="stat text-primary">
													<i class="align-center" data-feather="link"></i>
												</div>
											</a><br>
											<a href="new-registration.php">
												<h5>Link Vehicle</h5>
											</a>
										</div>
										<div class="single-action col-4 col-md-4 col-lg-4">
											<a href="#" class="d-flex justify-content-center track">
												<div class="stat text-primary">
													<i class="align-center" data-feather="shield"></i>
												</div>
											</a><br>
											<a href="#" class="track">
												<h5>Car Tracking</h5>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">Recent Registrations</h5>
								</div>

								<?php
								require_once "includes/time-ago.php";
								$sql = "SELECT * FROM registrations WHERE owner='" . $firstname . " " . $lastname . "' ORDER BY id DESC LIMIT 3";

								if ($result = mysqli_query($link, $sql)) {
									if (mysqli_num_rows($result) > 0) {
										echo "<div class='table-responsive'>";
										echo "<table id='myTable' class='display table table-striped table-hover mt-3 my-0'>";
										echo "<thead>";
										echo "<tr>";
										echo "<th>VID</th>";
										echo "<th class='d-none d-xl-table-cell'>Plate Number</th>";
										echo "<th>Status</th>";
										echo "<th class='d-none d-xl-table-cell'>Time</th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tbody>";
										while ($row = mysqli_fetch_array($result)) {
											$date = $row['date'];
											$time = get_time_ago(strtotime($date));
											$status = $row['status'];

											echo "<tr>";
											echo "<td>" . $row['registration_id'] . "</td>";
											echo "<td class='d-none d-xl-table-cell'>" . $row['plate_number'] . "</td>";
											echo "<td>";
											if ($status == "Processing") {
												echo "<span class='badge bg-warning'>$status</span>";
											} elseif ($status == "Completed") {
												echo "<span class='badge bg-success'>$status</span>";
											} elseif ($status == "Failed") {
												echo "<span class='badge bg-danger'>$status</span>";
											}
											echo "</td>";
											echo "<td class='d-none d-xl-table-cell'>" . $time . "</td>";
											echo "<div id='delete_post_conf'></div>";
											echo "</tr>";
										}
										echo "</tbody>";
										echo "</table>";
										echo "</div>";
										// Free result set
										mysqli_free_result($result);
									} else {
										echo "<h3 class='alert alert-success text-center p-5'>No records</h3>";
									}
								} else {
									echo "<p class='alert alert-warning'>Database not available. Contact developer</p>";
								}

								// Close connection
								mysqli_close($link);
								?>
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
	<?php
	if (isset($_GET['registration_complete'])) {
		echo "
		<script>
		swal
		.fire({
		title: 'Registration Submitted',
		text: '',
		icon: 'success',
		showCancelButton: false,
		confirmButtonColor: '#08cbbb',
		confirmButtonText: 'Close'
		}).then(function(){
		  window.location.href = '../dashboard/';
	  });
		</script>
		";
	}
	?>
</body>

</html>