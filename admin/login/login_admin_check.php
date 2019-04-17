<!-- Style of the pages admin -->
<link href="../css/style_admin.css" media="all" rel="stylesheet" type="text/css"/>

<?php 
	// Connextion to the database
	include("../../database/db_open.php");
	
	// Condition : reject the empty pseudo or password
	if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['password'])){
		
		// The pseudo and password entered before
		$login_AD = $_POST['login'];
		$password_AD = $_POST['password'];
		
		// Query selecting the password for a given pseudo
		$sql = "select password_admin from admin where username_admin='".$login_AD."'";
		$req = $con->query($sql);
		$data=$req->fetch(PDO::FETCH_ASSOC);
		
		// Function to check Hashed password
		function check_password($hash, $password) {
			$full_salt = substr($hash, 0, 29);
			$new_hash = crypt($password, $full_salt);
			return ($hash == $new_hash);
		}
		
		// Condition rejecting the uncorrect password
		if(check_password($data['password_admin'], $password_AD)){ 
			
			// Condition turning on the session variables if it is not
			if(!isset($_SESSION)){session_start();}
			
			// Session variables : pseudo
			$_SESSION['login'] = $login_AD;
			
			// Message about the connexion done
			echo "
			<div class='validation1'>
			<div class='validation2'>
			<p>You are successfully connected. Access Granted!</p>
			<p class='lien'>[ <a href=' ../index_admin.php'>Go to Admin panel.</a> ]</p>
			</div>
			</div>
			";
		}
		else{
			
			// Message about the connexion undone because of a problem at the database
			echo "
			<div class='validation1'>
			<div class='validation2'>
			<p>Your password is not correct. Access Denied!</p>
			<p class='lien'>[ <a href='login_admin_form.php'>Go to connexion panel.</a> ]</p>
			</div>
			</div>
			";
			exit;
		}   
	}
	else{
		// Message when the connexion is undone because of the password or login are empty
		echo "
        <div class='validation1'>
		<div class='validation2'>
		<p>An Error Happened.</p>
		<p class='lien'>[ <a href='login_admin_form.php'>Go to connexion panel.</a> ]</p>
		</div>  
		</div>
		";
	}
?>					