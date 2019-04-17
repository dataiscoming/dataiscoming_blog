<!-- Footer section of the website (not admin part)-->
<div class='footer-section'>
	
	<!-- left side of the footer section - empty -->
	<div class="footer-left"></div>
	
	<!-- List of differents links , according the thema -->  
	<div class="footer-center">

		<!-- Explore section -->
		<div class="footer-explore">
		<p>Explore</p>
			<span>
				<!-- Link to the Home -->
				<a href='../users/index_users.php?page=posts'>Home</a><br>
				<!-- Link to the admin connector -->
				<a href='../admin/login/login_admin_form.php'>Admin</a><br>
			</span>
		</div>

		<!-- Follow section -->
		<div class="footer-follow">
		<p>Follow</p>
			<span>
				<!-- Link to linkedin page -->
				<a href='https://www.linkedin.com/in/quentin-mouton-a4397b82/'>Linkedin</a><br>
				<!-- Link to github page -->
				<a href='https://github.com/dataiscoming'>Github</a><br>
			</span>	
		</div>
		<br>
		
		<!-- Legal section - empty  -->
		<div class="footer-legal"></div>
	</div>
	
	<!-- left side of the footer section - empty -->
	<div class="footer-left"></div>
	
	<?php
		/* Close the connection with the database*/
		include("../database/db_close.php");
	?>
</div>
