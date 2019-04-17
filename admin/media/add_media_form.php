<?php 
	// Header and Menu section for the admin
	include('../../layout/admin/header_admin.php'); 
	include('../../layout/admin/menu_admin.php'); 
	
	// Setting to allow the uploading of files
	ini_set('file_uploads', 'On'); 
?>

<html>
	<body> 
		<div id="index_admin">
			<!-- Form to upload a new media -->
			<form action="../../admin/media/add_media_action.php" method="post" enctype="multipart/form-data">
				<center>
					Select image to upload:
					<input type="file" name="fileToUpload" id="fileToUpload">
					<input type="submit" value="Upload Image" name="submit">
				</center>
			</form>
		</div>
	</body>
</html>
