<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("blogpage_controller.php"); ?>
<?php $Header = "Blog Page"; ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("Includes/Header.php"); ?>
<body>
	<!-- NAVBAR -->
	<div style="height:10px; background:#27aae1;"></div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a href="blogpage_html.php?page=1" class="navbar-brand">BELLE.COM</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarcollapseCMS">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a href="blogpage_html.php?page=1" class="nav-link">Home</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<form class="form-inline" action="blogpage_html.php">
					<div class="form-group">
					<input class="form-control mr-2" type="text" name="search" placeholder="Search here" value="">
					<button class="btn btn-primary" name="SearchButton">Go</button>
					</div>
				</form>
			</ul>
			</div>
		</div>
	</nav>
	<div style="height:10px; background:#27aae1;"></div>
	<!-- NAVBAR END -->
	
	<!-- HEADER -->
	
	<div class="container">
		<div class="row mt-4">
			<!-- Main Area -->
			<div class="col-sm-8" style="min-height:40px;">
				<?php echo ErrorMessage();
					  echo SuccessMessage(); ?>
				<h1>The Blog</h1>
				<?php
					for($i=0; $i < count($fetchedPosts); $i++){
				?>
				<div class="card mb-3">
					<img src="Uploads/<?php echo htmlentities($fetchedPosts[$i][6] /*Image*/); ?>" style="max-height:450px;" class="img-fluid card-top" />
					<div class="card-body">
						<h4 class="card-title"><?php echo htmlentities($fetchedPosts[$i][3]	/*Post Title*/); ?></h4>
						<small class="text-muted">
							Category: <span class="text-dark"><a href="blogpage_html.php?category=<?php echo $fetchedPosts[$i][4]	/*Category Name*/ ?>"><?php echo $fetchedPosts[$i][4]	/*Category Name*/ ?></a></span>
							& Written by <span class="text-dark"><?php echo htmlentities($fetchedPosts[$i][5] /*Admin*/); ?></span> on <?php echo htmlentities($fetchedPosts[$i][2] /*Date and Time*/); ?>
						 </small>
						<span style="float:right" class="badge badge-dark text-light">Comments <?php echo $OnComments[$i]; ?></span>
						<hr>
						<p class="card-text">
							<?php if(strlen($fetchedPosts[$i][7] /*Content*/)>150){
									$fetchedPosts[$i][7] /*Content*/ = substr($fetchedPosts[$i][7] /*Content*/,0,150)."...";
								  }
							echo htmlentities($fetchedPosts[$i][7] /*Content*/); ?></p>
						<a href="fullpost_html.php?id=<?php echo $fetchedPosts[$i][1]; /*ID*/ ?>" style="float:right">
							<span class="btn btn-info">Read More</span>
						</a>
					</div>
				</div>
				<?php } //End of for loop ?>
				<!-- Pagination -->
				
				<nav>
					<ul class="pagination pagination-lg">
						<?php //Backward button
						if(isset($Page)&&!empty($Page)){
							if($Page>1){
						
						?>
						<li class="page-item">
							<a href="blogpage_html.php?page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
						</li>
						<?php }} ?>
						<?php
						for($i=1;$i<=$PostPagination;$i++){
							if(isset($Page)&&!empty($Page)){
							if($i==$Page){
						?>
						<li class="page-item active">
							<a href="blogpage_html.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }else{ ?>
						<li class="page-item">
							<a href="blogpage_html.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }} ?>
						<?php } //End of for ?>
						<?php //Forward button
						if(isset($Page)&&!empty($Page)){
						if($Page+1<=$PostPagination){
						
						?>
						<li class="page-item">
							<a href="blogpage_html.php?page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
						</li>
						<?php }} ?>
					</ul>
				</nav>
				
				<!-- Pagination End -->
			</div>
			<!-- Main Area End -->
			<!-- Side Area -->
			
			<div class="col-sm-4" style="min-height:40px;">
				<div class="card mt-4">
					<div class="card-body">
						<img src="images/Green_Slime_Dangerous.png" class="d-block img-fluid mb-3" style="min-height:350px;" alt="">
						<div class="text-center">
							 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat non sapien a lacinia. Fusce vel dapibus sapien. Maecenas dapibus nunc vitae condimentum eleifend. Maecenas vulputate suscipit dictum. Fusce vestibulum pharetra tortor. Nam purus sapien, ultrices rhoncus quam eget, imperdiet tristique ipsum. Mauris varius vitae ligula eget efficitur. Nullam mattis nibh eros, eu elementum sem scelerisque at. Nullam nec fermentum metus. Vivamus quis nisi diam. 
						</div>
					</div>
				</div>
				<br>
				<div class="card">
					<div class="card-header bg-primary text-light">
						<h2 class="lead">Categories</h2>
					</div>
						<div class="card-body">
							<?php for($i=0; $i < count($categories); $i++){?>
							<a href="blogpage_html.php?category=<?php echo $categories[$i][2]; ?>"> <span class="heading"> <?php echo $categories[$i][2]; ?></span><br> </a>
							<?php } //End of for loop ?>
						</div>
				</div>
			</div>
			
			<!-- Side Area End -->
		</div>
	</div>
	
	<!-- HEADER END -->
	<br>
	<!-- FOOTER -->
	
	<?php require_once("Includes/Footer.php"); ?>
	
	<!-- FOOTER END -->
	
</body>
</html>