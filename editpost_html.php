<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("editpost_controller.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"]; ?>
<?php Confirm_Login(); ?>
<?php $Header = "Edit Post"; ?>
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
				<h1><i class="fas fa-edit"></i>Edit Post</h1>
				</div>
			</div>
		</div>
	</header>
	
	<!-- HEADER END -->
	
	<!-- MAIN AREA -->
	
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="offset-lg-1 col-lg-10" style="min-height:400px">
				<?php echo ErrorMessage();
					  echo SuccessMessage(); ?>
				<form class="" action="editpost_html.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
					<div class="card bg-secondary text-light mb-3">
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title"> <span class="FieldInfo"> Post Title: </span></label>
								<input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $fetchedPost[0][3]; //Title ?>"></input>
							</div>
							<div class="form-group">
								<span class="FieldInfo">Existing Category: </span>
								<?php echo $fetchedPost[0][4] /*Category*/."<br>"; ?>
								<label for="CategoryTitle"> <span class="FieldInfo"> Choose Category: </span></label>
								<select class="form-control" id="CategoryTitle" name="CategoryTitle">
									<?php for($i=0; $i < count($categoryOptions); $i++){?>
									<option> <?php echo $categoryOptions[$i][2]; ?> </option>
									<?php } //while for ending ?>
								</select>
							</div>
							<div class="form-group">
								<span class="FieldInfo">Existing Image: </span>
								<img src="Uploads/<?php echo $fetchedPost[0][6] /*Image*/; ?>">
								<br>
								<label for="image"> <span class="FieldInfo"> Image: </span></label>
								<div class="custom-file">
									<input class="custom-file-input" type="File" name="image" id="imageSelect">
									<label for="imageSelect" class="custom-file-label">Upload an image</label>
								</div>
							</div>
							<div class="form-group">
								<label for="PostTitle"> <span class="FieldInfo"> Post: </span></label>
								<textarea class="form-control" id="Post" name="Post" rows="8" cols="80"><?php echo $fetchedPost[0][7] /*Content*/;?></textarea>
							</div>
							<div class="row">
								<div class="col-lg-6 mb-2">
									<a href="dashboard_html.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
								</div>
								<div class="col-lg-6 mb-2">
									<button type="submit" name="Submit" class="btn btn-success btn-block">
										<i class="fas fa-check"></i>Edit
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
	
	
	<!-- MAIN AREA END -->
	
	<!-- FOOTER -->
	
	<?php require_once("Includes/Footer.php"); ?>
	
	<!-- FOOTER END -->
	
</body>
</html>