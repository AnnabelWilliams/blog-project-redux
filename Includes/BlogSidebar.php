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
							<?php for($i=0; $i < count($fetchedCategories); $i++){?>
							<a href="blogpage_html.php?category=<?php echo $fetchedCategories[$i][2]; ?>"> <span class="heading"> <?php echo $fetchedCategories[$i][2]; ?></span><br> </a>
							<?php } //End of for loop ?>
						</div>
				</div>
			</div>