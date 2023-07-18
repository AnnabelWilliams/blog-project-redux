<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("dashboard_controller.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"]; ?>
<?php Confirm_Login(); ?>
<?php $Header = "Dashboard"; ?>
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
					<h1><i class="fa-solid fa-cog" style="color:#27aae1;"></i> Dashboard </h1>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="addposts_html.php" class="btn btn-primary btn-block">
						<i class="fas fa-edit"></i> Add New Post
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="categories_html.php?page=1" class="btn btn-info btn-block">
						<i class="fas fa-folder-plus"></i> Add New Category
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="admins_html.php?page=1" class="btn btn-warning btn-block">
						<i class="fas fa-user-plus"></i> Add New Admin
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="comments_html.php?upage=1&apage=1" class="btn btn-success btn-block">
						<i class="fas fa-check"></i> Approve Comments
					</a>
				</div>
			</div>
		</div>
	</header>
	
	<!-- HEADER END -->
	
	<!-- MAIN AREA -->
	
	<section class="container py-2 mb-4">
		<?php echo ErrorMessage();
		      echo SuccessMessage(); ?>
		<div class="row">
			<!-- LEFT AREA -->
			<div class="col-lg-2">
				<div class="card text-center bg-dark text-white mb-3">
				<a href="blogposts_html.php?page=1" class="btn btn-dark btn-block text-white">
					<div class="card-body">
						<h1 class="lead">Posts</h1>
						<h4 class="display-5">
							<i class="fab fa-readme"></i>
							<?php echo $postCount ?>
						</h4>
					</div>
				</a>
				</div>
				<div class="card text-center bg-dark text-white mb-3">
				<a href="categories_html.php?page=1" class="btn btn-dark btn-block text-white">
					<div class="card-body">
						<h1 class="lead">Categories</h1>
						<h4 class="display-5">
							<i class="fas fa-folder"></i>
							<?php echo $categoryCount ?>
						</h4>
					</div>
				</a>
				</div>
				<div class="card text-center bg-dark text-white mb-3">
				<a href="admins_html.php?page=1" class="btn btn-dark btn-block text-white">
					<div class="card-body">
						<h1 class="lead">Admins</h1>
						<h4 class="display-5">
							<i class="fas fa-users"></i>
							<?php echo $adminCount ?>
						</h4>
					</div>
				</a>
				</div>
				<div class="card text-center bg-dark text-white mb-3">
				<a href="comments_html.php?upage=1&apage=1" class="btn btn-dark btn-block text-white">
					<div class="card-body">
						<h1 class="lead">Comments</h1>
						<h4 class="display-5">
							<i class="fas fa-comments"></i>
							<?php echo $commentCount ?>
						</h4>
					</div>
				</a>
				</div>
			</div>
			<!-- LEFT AREA END-->
			<!-- RIGHT AREA -->
			<div class="col-lg-10">
				<h1>Top Posts</h1>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No.</th>
							<th>Title</th>
							<th>Date&Time</th>
							<th>Author</th>
							<th>Comments</th>
							<th>Details</th>
						</tr>
					</thead>
					<?php
					for($i=0; $i < 5; $i++){
					?>
					<tbody>
						<tr>
							<td><?php echo $fetchedPosts[$i][0] //ID ?></td>
							<td><?php echo $fetchedPosts[$i][3] //Post Title ?></td>
							<td><?php echo $fetchedPosts[$i][2]	//Date and Time ?></td>
							<td><?php echo $fetchedPosts[$i][5]	//Admin ?></td>
							<td>
								<span class="badge badge-success"><?php echo $OnComments[$i]; ?></span>
								<span class="badge badge-danger"><?php echo $OffComments[$i]; ?></span>
							</td>
							<td>
								<a target="_blank" href="fullpost_html.php?id=<?php echo $fetchedPosts[$i][0] ?>">
								<span class="btn btn-info">Preview</span>
								</a>
							</td>
						</tr>
					</tbody>
					<?php } // End of for loop ?>
				</table>
			</div>
			<!-- RIGHT AREA END-->
		</div>
	</section>
	
	<!-- MAIN AREA END -->
	
	<!-- FOOTER -->
	
	<?php require_once("Includes/Footer.php"); ?>
	
	<!-- FOOTER END -->
	
</body>
</html>