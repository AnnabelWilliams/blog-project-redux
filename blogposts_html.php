<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Roles.php"); ?>
<?php require_once("blogposts_controller.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"]; ?>
<?php Confirm_Login(); ?>
<?php $Header = "Blog Posts"; ?>
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
					<h1><i class="fa-solid fa-blog" style="color:#27aae1;"></i> Blog Posts </h1>
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
					<a href="comments_html.php" class="btn btn-success btn-block">
						<i class="fas fa-check"></i> Approve Comments
					</a>
				</div>
			</div>
		</div>
	</header>
	
	<!-- HEADER END -->
	
	<!-- MAIN AREA -->
	
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="col-lg-12">
				<?php echo ErrorMessage();
					  echo SuccessMessage(); ?>
				<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Category</th>
						<th>Date&Time</th>
						<th>Author</th>
						<th>Banner</th>
						<th>Comments</th>
						<th>Action</th>
						<th>Live Preview</th>
					</tr>
				</thead>
					<?php
					for($i=0; $i < count($fetchedPosts); $i++){
					?>
					<tbody>
					<tr>
						<td><?php echo $fetchedPosts[$i][0] //ID?></td>
						<td><?php echo $fetchedPosts[$i][3]	//Post Title ?></td>
						<td><?php echo $fetchedPosts[$i][4]	//Category Name ?></td>
						<td><?php echo $fetchedPosts[$i][2]	//Date and Time ?></td>
						<td><?php echo $fetchedPosts[$i][5]	//Admin ?></td>
						<td><img src="Uploads/<?php echo $fetchedPosts[$i][6] //Image ?>" width="170px;"</td>
						<td>
							<span class="badge badge-success"><?php echo $OnComments[$i]; ?></span>
							<span class="badge badge-danger"><?php echo $OffComments[$i]; ?></span>
						</td>
						<td>
							<?php if($_SESSION["Role"] & PostEditor){ ?>
							<a href="editpost_html.php?id=<?php echo $fetchedPosts[$i][1]; ?>"><span class="btn btn-warning mb-1">Edit</span></a>
							<?php } ?>
							<?php if($_SESSION["Role"] & PostDeleter){ ?>
							<a href="deletepost_html.php?id=<?php echo $fetchedPosts[$i][1]; ?>"><span class="btn btn-danger mb-1">Delete</span></a>
							<?php } ?>
						</td>
						<td><a href="fullpost_html.php?id=<?php echo $fetchedPosts[$i][1]; ?>" taget="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
					</tr>
					</tbody>
					<?php } //End of while loop ?>
				</table>
			<!-- Pagination -->
				<nav>
					<ul class="pagination pagination-lg">
						<?php //Backward button
						if(isset($Page)&&!empty($Page)){
						if($Page>1){
						
						?>
						<li class="page-item">
							<a href="blogposts_html.php?page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
						</li>
						<?php }} ?>
						<?php
						for($i=1;$i<=$PostPagination;$i++){
							if(isset($Page)&&!empty($Page)){
							if($i==$Page){
						?>
						<li class="page-item active">
							<a href="blogposts_html.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }else{ ?>
						<li class="page-item">
							<a href="blogposts_html.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }} ?>
						<?php } //End of for ?>
						<?php //Forward button
						if(isset($Page)&&!empty($Page)){
						if($Page+1<=$PostPagination){
						
						?>
						<li class="page-item">
							<a href="blogposts_html.php?page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
						</li>
						<?php }} ?>
					</ul>
				</nav>
			<!-- Pagination End -->
			</div>
		</div>
	</section>
	
	<!-- MAIN AREA END -->
	
	<!-- FOOTER -->
	
	<?php require_once("Includes/Footer.php"); ?>
	
	<!-- FOOTER END -->
	
</body>
</html>