<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("fullpost_controller.php"); ?>
<?php $Header = "Full Post"; ?>
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
				<h1>The Blog</h1>
				<div class="card mb-3">
					<img src="Uploads/<?php echo htmlentities($fetchedPosts[0][6] /*Image*/); ?>" style="max-height:450px;" class="img-fluid card-top" />
					<div class="card-body">
						<h4 class="card-title"><?php echo htmlentities($fetchedPosts[0][3]); //Post Title ?></h4>
						<small class="text-muted"> Category: <span class="text-dark"><a href="blogpage_html.php?category=<?php echo $fetchedPosts[0][4]	/*Category Name*/ ?>"><?php echo $fetchedPosts[0][4]	/*Category Name*/ ?></a></span> 
						& Written by <span class="text-dark"><?php echo htmlentities($fetchedPosts[0][5]  /*Admin*/); ?></span> on <?php echo htmlentities($fetchedPosts[0][2] /*Date and Time*/); ?> </small>
						<hr>
						<p class="card-text">
							<?php echo nl2br($fetchedPosts[0][7] /*Content*/); ?></p>
					</div>
				</div>
				<!--Comment Submit Area-->
				<!--Fetch Comments-->
				
					<span class="FieldInfo">Comments</span>
				
				<?php
					for($i=0; $i < count($fetchedComments); $i++){
				?>
				
				<div class="">
					<div class="media CommentBlock">
						<div class="media-body ml-2 text-break">
							<h6 class="lead"><?php echo $fetchedComments[$i][3]; //CommenterName ?></h6>
							<p class="small"><?php echo $fetchedComments[$i][2]; //DateTime ?></p>
							<p><?php echo $fetchedComments[$i][4]; //Comment Text ?></p>
						</div>
					</div>
				</div>
				<hr>
				
				<?php } //End of while loop ?>
				
				<!--Fetch Comments End-->
				<div class="">
					<?php echo ErrorMessage();
					      echo SuccessMessage(); ?>
					<form class="" action="fullpost_html.php?id=<?php echo $SearchQueryParameter ?>" method="post">
						<div class="card mb-3">
							<div class="card-header">
								<h5 class="FieldInfo">Share your thoughts about this post</h5>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<input class="form-control" type="text" name="CommenterName" placeholder="Name" value="">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-envelope"></i></span>
										</div>
										<input class="form-control" type="email" name="CommenterEmail" placeholder="Email" value="">
									</div>
								</div>
								<div class="form-group">
									<textarea name="CommentText" class="form-control" rows="6" cols="80"></textarea>
								</div>
								<div class="">
									<button type="submit" name="Submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!--Comment Submit Area End-->
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