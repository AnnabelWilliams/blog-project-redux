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
	<?php require_once("Includes/BlogNavbar.php"); ?>
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
			<?php require_once("Includes/BlogSidebar.php"); ?>
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