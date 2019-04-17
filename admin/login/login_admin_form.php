<html>

	<head>
		<!-- Meta -->
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta http-equiv="Cache-Control" content="no-cache" /> 
		
		<!-- Style of the pages admin -->
		<link href="../css/style_admin.css" media="all" rel="stylesheet" type="text/css"/>
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="../../pictures/logo.png" />
		
		<!-- check in case of deleting -->
		<script type="text/javascript" src="java/xdir.js"></script>
	</head>
	
	<body>
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<br /><br /><br /><br /><br /><br /><br /><br /><br />
		<center>
			<!-- Form to check the pseudo and password to connect to the admin panel login_admin_check.php -->
			<form action="login_admin_check.php" method='post'>
				
				<!-- Table with the form -->
				<table border="0" class="membre" width="400" height="110">
					<tr>
						<td colspan="2"><b>Zone for the administrator:</b></td>
					</tr>
					
					<!-- Login part -->
					<tr>
						<td width="125">Login</td>
						<td><input type="text" name="login" /></td>
					</tr>
					
					<!-- password part -->
					<tr>
						<td width="125">Password</td>
						<td colspan="2"><input type="password" name="password" /></td>
						
					</tr>
					
					<!-- Submit part -->
					<tr>
						<td colspan="2" align="center"><input type="submit" value="Connexion" /></td>
					</tr>
				</table>
			</form>
			
			<!-- Link to the blog -->
			<p class="lien">[ <a href=" ../../users/index_users.php?page=posts">Back to the blog</a> ]</p>
		</center>
	</body>
</html>
		