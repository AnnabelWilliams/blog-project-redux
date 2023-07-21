<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("categories_controller.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"]; ?>
<?php Confirm_Login(); ?>
<?php $Header = "Category"; ?>
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
				<h1><i class="fas fa-edit"></i>Manage Categories</h1>
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
				<form class="" action="categories_html.php" method="post">
					<div class="card bg-secondary text-light mb-3">
						<div class="card-header">
							<h1>Add New Category</h1>
						</div>
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title"> <span class="FieldInfo"> Category Title: </span></label>
								<input class="form-control" type="text" name="Title" id="title" placeholder="Type title here"></input>
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
				<h2>Existing Categories</h2>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No. </th>
							<th>Title</th>
							<th>Author</th>
							<th>Date&Time</th>
							<th>Delete</th>
						</tr>
					</thead>
					<?php
					for($i=0; $i < count($fetchedCategories); $i++){
					?>
					<tbody>
						<tr>
							<td><?php echo htmlentities($fetchedCategories[$i][0]); //SrNo ?></td>
							<td><?php echo htmlentities($fetchedCategories[$i][2]); //Name ?></td>
							<td><?php echo htmlentities($fetchedCategories[$i][3]); //Author ?></td>
							<td><?php echo htmlentities($fetchedCategories[$i][4]); //DateTime ?></td>
							<td><a class="btn btn-danger" href="deletecategory_controller.php?id=<?php echo $fetchedCategories[$i][1]; //Id ?>">Delete</a></td>
						</tr>
					</tbody>
					<?php } // End of for loop ?>
				</table>
				<!-- Pagination -->
				<nav>
					<ul class="pagination pagination-lg">
						<?php //Backward button
						if(isset($Page)&&!empty($Page)){
						if($Page>1){
						
						?>
						<li class="page-item">
							<a href="categories_html.php?page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
						</li>
						<?php }} ?>
						<?php
						for($i=1;$i<=$CategoryPagination;$i++){
							if(isset($Page)&&!empty($Page)){
							if($i==$Page){
						?>
						<li class="page-item active">
							<a href="categories_html.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }else{ ?>
						<li class="page-item">
							<a href="categories_html.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
						</li>
							<?php }} ?>
						<?php } //End of for ?>
						<?php //Forward button
						if(isset($Page)&&!empty($Page)){
						if($Page+1<=$CategoryPagination){
						
						?>
						<li class="page-item">
							<a href="categories_html.php?page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
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