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