<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Roles.php"); ?>
<?php require_once("myprofile_controller.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"]; ?>
<?php Confirm_Login(); ?>
<?php $Header = "My Profile"; ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("Includes/Header.php"); ?>
<body>
	<!-- NAVBAR -->
	<?php require_once("Includes/Navbar.php"); ?>
	<!-- NAVBAR END -->
	
	<!-- HEADER -->
	
	<header class="bg-dark text-white py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<h1><i class="fas fa-user text-success mr-2"></i>@<?php echo $currentAdmin[1]; //Username ?></h1>
				<h2><?php echo $currentAdmin[2]; //Headline ?></h2>
				</div>
			</div>
		</div>
	</header>
	
	<!-- HEADER END -->
	
	<!-- MAIN AREA -->
	
	<section class="container py-2 mb-4">
		<div class="row">
			<!-- Left Area -->
			<div class="col-md-3">
				<div class="card">
					<div class="card-header bg-dark text-light">
						<h3><?php echo $currentAdmin[0]; //Name ?></h3>
					</div>
					<div class="card-body">
						<img src="Images/<?php echo $currentAdmin[4]; //Image ?>" class="block img-fluid mb-3" alt="">
						<div class="">
							<?php echo $currentAdmin[3]; //Bio ?>
						</div>
					</div>
				</div>
			</div>
			<!-- Left Area End -->
			<!-- Right Area -->
			<div class="col-md-9" style="min-height:400px">
				<?php echo ErrorMessage();
					  echo SuccessMessage(); ?>
				<form class="" action="myprofile_html.php" method="post" enctype="multipart/form-data">
					<div class="card bg-secondary text-light mb-3">
						<div class="card-header bg-secondary text-light">
							<h4>Edit Profile</h4>
						</div>
						<div class="card-body bg-dark">
							<div class="form-group">
								<input class="form-control" type="text" name="Name" id="title" placeholder="Your name here" value="<?php echo $currentAdmin[0]; //Name ?>"></input>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="Headline" id="title" placeholder="Headline" value="<?php echo $currentAdmin[2]; //Headline ?>"></input>
								<small class="text-muted">Add a professional headline</small>
								<span class="text-danger">Not more than 12 characters</span>
							</div>
							<div class="form-group">
								<textarea placeholder="Bio" class="form-control" id="Post" name="Bio" rows="8" cols="80"><?php echo $currentAdmin[3]; //Bio ?></textarea>
							</div>
							<div class="form-group">
								<div class="custom-file">
									<input class="custom-file-input" type="File" name="image" id="imageSelect" value="">
									<label for="imageSelect" class="custom-file-label">Upload an image</label>
								</div>
							</div>
							<h2>Roles</h2>
							<div class="form-group">
								<input type="checkbox" name="Deleter" id="Deleter" value="Deleter"
									<?php if($_SESSION["Role"] & PostDeleter){ ?>
										checked
									<?php } ?>
								>
								<label for="Deleter">Post Deleter</label>
								<br>
								<input type="checkbox" name="Creator" id="Creator" value="Creator"
									<?php if($_SESSION["Role"] & PostCreator){ ?>
										checked
									<?php } ?>
								>
								<label for="Creator">Post Creator</label>
								<br>
								<input type="checkbox" name="Editor" id="Editor" value="Editor"
									<?php if($_SESSION["Role"] & PostEditor){ ?>
										checked
									<?php } ?>
								>
								<label for="Editor">Post Editor</label>
							</div>
							<div class="row">
								<div class="col-lg-6 mb-2">
									<a href="dashboard_html.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
								</div>
								<div class="col-lg-6 mb-2">
									<button type="submit" name="Submit" class="btn btn-success btn-block">
										<i class="fas fa-check"></i>Publish
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Right Area End -->
		</div>
	</section>
	
	
	<!-- MAIN AREA END -->
	
	<!-- FOOTER -->
	
	<?php require_once("Includes/Footer.php"); ?>
	
	<!-- FOOTER END -->

</body>
</html>