<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("comments_controller.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"]; ?>
<?php Confirm_Login(); ?>
<?php $Header = "Comments"; ?>
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
				<h1><i class="fas fa-comments" style="color:#27aae1;"></i> Manage Comments</h1>
				</div>
			</div>
		</div>
	</header>
	
	<!-- HEADER END -->
	
	<!-- MAIN AREA -->
	
	<section class="container py-2 mb-4">
		<div class="row" style="min-height:30px;">
			<div class="col-lg-12" style="min-height:400px;">
				<?php echo ErrorMessage();
					  echo SuccessMessage(); ?>
				<h2>Unapproved Comments</h2>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No. </th>
							<th>Name</th>
							<th>Date&Time</th>
							<th>Comment</th>
							<th>Approve</th>
							<th>Delete</th>
							<th>Details</th>
						</tr>
					</thead>
				<?php
					for($i=0; $i < count($fetchedUnapprovedComments); $i++){
				?>
					<tbody>
						<tr>
							<td><?php echo htmlentities($fetchedUnapprovedComments[$i][0]); //SrNo ?></td>
							<td style="word-wrap: break-word;min-width: 160px;max-width: 450px;"><?php echo htmlentities($fetchedUnapprovedComments[$i][3]); //Commenter Name ?></td>
							<td><?php echo htmlentities($fetchedUnapprovedComments[$i][2]); //DateTime ?></td>
							<td style="word-wrap: break-word;min-width: 160px;max-width: 450px;"><?php echo htmlentities($fetchedUnapprovedComments[$i][4]); //Content ?></td>
							<td><a class="btn btn-success" href="approvecomment_controller.php?id=<?php echo $fetchedUnapprovedComments[$i][1]; //Id ?>">Approve</a></td>
							<td><a class="btn btn-danger" href="deletecomment_controller.php?id=<?php echo $fetchedUnapprovedComments[$i][1]; //Id ?>">Delete</a></td>
							<td><a class="btn btn-primary" href="fullpost_html.php?id=<?php echo $fetchedUnapprovedComments[$i][5]; //Post Id ?>">Live Preview</a></td>
						</tr>
					</tbody>
					<?php } // End of while loop ?>
				</table>
				<!-- Pagination -->
				<nav>
					<ul class="pagination pagination-lg">
						<?php //Backward button
						if(isset($UPage)&&!empty($UPage)){
						if($UPage>1){
						
						?>
						<li class="page-item">
							<a href="comments_html.php?upage=<?php echo $UPage-1; ?>&apage=1" class="page-link">&laquo;</a>
						</li>
						<?php }} ?>
						<?php
						for($i=1;$i<=$CommentPaginationOff;$i++){
							if(isset($UPage)&&!empty($UPage)){
							if($i==$UPage){
						?>
						<li class="page-item active">
							<a href="comments_html.php?upage=<?php echo $i; ?>&apage=1" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }else{ ?>
						<li class="page-item">
							<a href="comments_html.php?upage=<?php echo $i; ?>&apage=1" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }} ?>
						<?php } //End of for ?>
						<?php //Forward button
						if(isset($UPage)&&!empty($UPage)){
						if($UPage+1<=$CommentPaginationOff){
						
						?>
						<li class="page-item">
							<a href="comments_html.php?upage=<?php echo $UPage+1; ?>&apage=1" class="page-link">&raquo;</a>
						</li>
						<?php }} ?>
					</ul>
				</nav>
			<!-- Pagination End -->
				<h2>Approved Comments</h2>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No. </th>
							<th>Name</th>
							<th>Date&Time</th>
							<th>Comment</th>
							<th>Disapprove</th>
							<th>Delete</th>
							<th>Details</th>
						</tr>
					</thead>
				<?php
					for($i=0; $i < count($fetchedApprovedComments); $i++){
				?>
					<tbody>
						<tr>
							<td><?php echo htmlentities($fetchedApprovedComments[$i][0]); //SrNo ?></td>
							<td style="word-wrap: break-word;min-width: 160px;max-width: 450px;"><?php echo htmlentities($fetchedApprovedComments[$i][3]); //Commenter Name ?></td>
							<td><?php echo htmlentities($fetchedApprovedComments[$i][2]); //DateTime ?></td>
							<td style="word-wrap: break-word;min-width: 160px;max-width: 450px;"><?php echo htmlentities($fetchedApprovedComments[$i][4]); //Content ?></td>
							<td><a class="btn btn-warning" href="disapprovecomment_controller.php?id=<?php echo $fetchedApprovedComments[$i][1]; //Id ?>">Disapprove</a></td>
							<td><a class="btn btn-danger" href="deletecomment_controller.php?id=<?php echo $fetchedApprovedComments[$i][1]; //Id ?>">Delete</a></td>
							<td><a class="btn btn-primary" href="fullpost_html.php?id=<?php echo $fetchedApprovedComments[$i][5]; //Post Id ?>">Live Preview</a></td>
						</tr>
					</tbody>
					<?php } // End of while loop ?>
				</table>
				<!-- Pagination -->
				<nav>
					<ul class="pagination pagination-lg">
						<?php //Backward button
						if(isset($APage)&&!empty($APage)){
						if($APage>1){
						
						?>
						<li class="page-item">
							<a href="comments_html.php?apage=<?php echo $APage-1; ?>&upage=1" class="page-link">&laquo;</a>
						</li>
						<?php }} ?>
						<?php
						for($i=1;$i<=$CommentPaginationOn;$i++){
							if(isset($APage)&&!empty($APage)){
							if($i==$APage){
						?>
						<li class="page-item active">
							<a href="comments_html.php?apage=<?php echo $i; ?>&upage=1" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }else{ ?>
						<li class="page-item">
							<a href="comments_html.php?apage=<?php echo $i; ?>&upage=1" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }} ?>
						<?php } //End of for ?>
						<?php //Forward button
						if(isset($APage)&&!empty($APage)){
						if($APage+1<=$CommentPaginationOn){
						
						?>
						<li class="page-item">
							<a href="comments_html.php?apage=<?php echo $APage+1; ?>&upage=1" class="page-link">&raquo;</a>
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