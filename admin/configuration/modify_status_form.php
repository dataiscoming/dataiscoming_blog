<?php 
	// Connextion to the database
	include("../../database/db_open.php");
	
	// Get the actual status of the website
	$sql = "select * from eta_web_sit where id=1";
	$query = $con->query($sql);
	$data=$query->fetch(PDO::FETCH_ASSOC);
?>

<html>
	<body>
		<?php 
			// Header and Menu sections for the admin
			include('../../layout/admin/header_admin.php'); 
			include('../../layout/admin/menu_admin.php');
		?>
		<div id='index_admin'>
			<center>
				<!-- Form to get the new value of the status of the website -->
				Change the actual state of the website: <b><?php echo $data['ETA']; ?></b> by : <br /><br />
				<form action="modify_status_action.php" method="post">
					<input type="text" name="new_eta" size="30" />
					<input type="hidden" name="old_eta" value="<?php echo $data['ETA']; ?>">
					<input type="submit" value="Send" />
				</form>
			</center>
		</div>
	</body>
</html>