<?php // Import the permission check
include('../layout/users/check_permission_users.php');
?>

<?php // Save the session and store it to the cookies
include('../layout/users/Save_session.php')
?>

<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->

<html class="no-js" lang="en"> <!--<![endif]-->
	
	<?php // Import the Headers common to the admin and users screens
	include('../layout/users/global_header_users.php');
	?>

<body class="homepage">

	<?php // Import the preloader screen
	include('../layout/users/preloader_users.php');
	?>

	<?php // Import the headers for the users screen
	include('../layout/users/header_users.php');
	?>
	
	<?php // Import The Hero with global messages and links
	include('../layout/users/hero_users.php');
	?>

	<?php // Import the journal with different abstract of posts 
	include('../users/journal_users.php');
	?>

	<?php // Import the footer with links
	include('../layout/users/footer_users.php');
	?>

	<?php // Import the cookie banner always seen if not closed
	include('../layout/users/Cookie_banner.php');
	?>

</body>

</html>