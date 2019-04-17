<html>
	
	<!-- Container for the whole page, useful to avoid the blanks all around -->
	<div id="container">
		
		<?php 
			// Header section
			include("../layout/users/header_users.php");

			// Menu section
			include("../layout/users/menu_users.php");
	
		?>
			<div class='body-section'>
			
				<!-- Left side part -->
				<div class='body-side-left'></div>
			
				<!-- Main part of the page : articles -->
				<div class='body-center'>
			
				<?php
				// Body section 
				include("../users/tabs/body_".$_GET['page'].".php");
			
				// Right side section 
				include("../layout/users/right_side_users.php");
				?>
				</div>
	
				<!-- Right side part -->
				<div class='body-side-right'></div>

			</div>

	</div>
		<?php // Footer section 
			include("../layout/users/footer_users.php");
		?>
</html>																																																	