<?php  include('../db/db.php'); ?>
<?php  include('admin_functions.php'); ?>
<?php 
	$roles = ['admin', 'user'];
	$username = ['username'];			
?>
	<title>Admin | Manage users</title>
</head>
<body>
	<div class="container content">
		<!-- Left side menu -->
		<?php include('menu.php') ?>
		<!-- Create admin  -->
		<div class="action">
			<h2 class="page-title">Create admin user</h2>

			<form method="post" action="admin_functions.php">

				<input type="text" name="username" value="" placeholder="Username">
				<input type="password" name="password" placeholder="Password">
				<select name="role">
					<option value="" selected disabled>Assign role</option>
					<?php foreach ($roles as $key => $role): ?>
						<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
					<?php endforeach ?>
				</select>
				<button type="submit" class="btn" name="create_user">Save user</button>
			</form>
		</div>
		
	</div>
</body>
</html>