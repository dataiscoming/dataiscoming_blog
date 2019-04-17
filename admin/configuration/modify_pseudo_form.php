<html>
	<body>
		<?php
			// Header and Menu section for the admin 
			include('../../layout/admin/header_admin.php'); 
			include('../../layout/admin/menu_admin.php');
		?>
		<div id='index_admin'>
			<center>
				<!-- Form to get the new value of the pseudo -->
				Change your actual password : <b><?php echo $_SESSION['login']; ?></b> by : <br /><br />
				<form action="modify_pseudo_action.php" method="post">
					<input type="text" name="new_pseudo" size="30" />
					<input type="hidden" name="old_pseudo" value="<?php echo $_SESSION['login']; ?>">
					<input type="submit" value="Send" />
				</form>
			</center>
		</div>
	</body>
</html>