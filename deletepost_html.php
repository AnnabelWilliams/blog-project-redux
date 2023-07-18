<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("deletepost_controller.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"]; ?>
<?php Confirm_Login(); ?>
<?php $Header = "Delete Post"; ?>
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
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a href="myprofile_html.php" class="nav-link text-success"><i class="fa-solid fa-user"></i> <?php echo $_SESSION["Username"]; ?></a>
				</li>
				<li class="nav-item">
					<a href="dashboard_html.php" class="nav-link">Dashboard</a>
				</li>
				<li class="nav-item">
					<a href="blogposts_html.php?page=1" class="nav-link">Posts</a>
				</li>
				<li class="nav-item">
					<a href="categories_html.php?page=1" class="nav-link">Categories</a>
				</li>
				<li class="nav-item">
					<a href="admins_html.php?page=1" class="nav-link">Manage Admins</a>
				</li>
				<li class="nav-item">
					<a href="comments_html.php?upage=1&apage=1" class="nav-link">Comments</a>
				</li>
				<li class="nav-item">
					<a href="blogpage_html.php?page=1" class="nav-link">Live Blog</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a href="logout_controller.php" class="nav-link text-danger">
				<i class="fa-solid fa-user-times"></i> Logout</a></li>
			</ul>
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
				<h1><i class="fas fa-edit"></i>Delete Post</h1>
				</div>
			</div>
		</div>
	</header>
	
	<!-- HEADER END -->
	
	<!-- MAIN AREA -->
	
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="offset-lg-1 col-lg-10" style="min-height:400px">
				<?php 
					echo ErrorMessage();
					echo SuccessMessage();
				?>
				<form class="" action="deletepost_html.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
					<div class="card bg-secondary text-light mb-3">
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title"> <span class="FieldInfo"> Post Title: </span></label>
								<input disabled class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $fetchedPost[0][3]; //Title ?>"></input>
							</div>
							<div class="form-group">
								<span class="FieldInfo">Existing Category: </span>
								<?php echo $fetchedPost[0][4] /*Category*/."<br>"; ?>
							</div>
							<div class="form-group">
								<span class="FieldInfo">Existing Image: </span>
								<img src="Uploads/<?php echo $fetchedPost[0][6] /*Image*/; ?>">
							</div>
							<div class="form-group">
								<label for="PostTitle"> <span class="FieldInfo"> Post: </span></label>
								<textarea disabled class="form-control" id="Post" name="Post" rows="8" cols="80"><?php echo $fetchedPost[0][7] /*Content*/;?></textarea>
							</div>
							<div class="row">
								<div class="col-lg-6 mb-2">
									<a href="dashboard_html.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
								</div>
								<div class="col-lg-6 mb-2">
									<button type="submit" name="Submit" class="btn btn-danger btn-block">
										<i class="fas fa-trash"></i>Delete
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