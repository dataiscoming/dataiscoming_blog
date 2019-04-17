<html>
	<body>
		
		<!-- Header and menu section for the admin -->
		<?php include('../../layout/admin/header_admin.php') ?>
		<?php include('../../layout/admin/menu_admin.php') ?>
		
		<div id="index_admin">
			<center>
				
				<!-- Check and modification of the pseudo -->
				Your actual pseudo is :
				<?php echo $_SESSION['login']; ?> (<a href="modify_pseudo_form.php">Modifiy</a>)<br /> Your actual password is :
				<?php require("../../database/db_open.php");
					$login = $_SESSION['login'];
					print_r($login);
					$sql = "select * from admin where username_admin='".$login."'";
					$query = $con->query($sql);
					$data=$query->fetch(PDO::FETCH_ASSOC);
					
					/* Check and modification of the password */
				echo $data['password_admin'];?> (<a href="modify_pwd_form.php">Modify</a>)<br /> Your actual e-mail is :
				<?php echo $data['mail_admin']; ?><br>
				
				<!-- Check and modification of the status of the website -->
				The status of the blog is :
				<?php require("../../database/db_open.php");
					$sql = "select * from eta_web_sit where id=1";
					$query = $con->query($sql);
					$data=$query->fetch(PDO::FETCH_ASSOC);
				echo $data['ETA'];?> (<a href="modify_status_form.php">Modify</a>)
				
			</center>
		</div>
	</body>
</html>