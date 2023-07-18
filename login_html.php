<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("login_controller.php"); ?>
<?php $Header = "Login"; ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("Includes/Header.php"); ?>
<body>
	<!-- NAVBAR -->
	<div style="height:10px; background:#27aae1;"></div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a href="#" class="navbar-brand">BELLE.COM</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarcollapseCMS">
			</div>
		</div>
	</nav>
	<div style="height:10px; background:#27aae1;"></div>
	<!-- NAVBAR END -->
	
	<!-- HEADER -->
	
	<header class="bg-dark text-white py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				</div>
			</div>
		</div>
	</header>
	
	<!-- HEADER END -->
	
	<!-- MAIN AREA -->
	
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="offset-sm-3 col-sm-6" style="min-height:400px">
				<?php echo ErrorMessage();
					  echo SuccessMessage(); ?>
				<div class="card bg-secondary text-light">
					<div class="card-header">
						<h4>Login</h4>
					</div>
					<div class="card-body bg-dark">
						<form class="" action"login_html.php" method="post">
							<div class="form-group">
								<label for="username"><span class="FieldInfo">Username:</span></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text text-white bg-info"><i class="fas fa-user"></i><span>
									</div>
									<input type="text" class="form-control" name="Username" id="username">
								</div>
							</div>
							<div class="form-group">
								<label for="password"><span class="FieldInfo">Password:</span></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i><span>
									</div>
									<input type="password" class="form-control" name="Password" id="password">
								</div>
							</div>
							<input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- MAIN AREA END -->
	
	<!-- FOOTER -->
	
	<?php require_once("Includes/Footer.php"); ?>
	
	<!-- FOOTER END -->
	
</body>
</html>