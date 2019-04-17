<?php
	//Header section for the admin
	include('../../layout/admin/header_admin.php');
	
	// Connexion to the database
	include("../../database/db_open.php");
	
	// Getting the last password from the database
	$login = $_SESSION['login'];
	$query = "select password_admin from admin where username_admin='".$login."'";
	$query = $con->query($sql);
	$data=$query->fetch(PDO::FETCH_ASSOC);
?>

<html>
	<body>
		
		<?php 
			// Menu section for the admin
			include('../../layout/admin/menu_admin.php')
		?>
		
		<!-- Form to get the new value of the password -->
		<div id='index_admin'>
			<center>
				Change your actual password : <b><?php echo $data['password_admin'] ?></b> by : <br /><br />
				<form action="modify_pwd_action.php" method="post">
					<input type="text" name="new_pwd" size="30" />
					<input type="hidden" name="old_pwd" value="<?php echo $data['password_admin'] ?>">
					<input type="submit" value="Send" />
				</form>
			</center>
		</div>
	</body>
</html>
