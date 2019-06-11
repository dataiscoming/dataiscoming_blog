<!-- Header section of the visible website for the users (not the admin part) -->
<div class='header-section'>
	
	<!-- check if the website is not under maintenance -->
	<?php include('../layout/users/check_permission_users.php');?>	

	<!-- Meta -->
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache" /> 
	
	<!-- CSS Style sheets -->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Fondamento"/> <!-- Font -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- font -->
	<link href="../css/style_global_users.css" media="all" rel="stylesheet" type="text/css"/> <!-- Global style of the website -->
	<link href="../css/style_header_users.css" media="all" rel="stylesheet" type="text/css"/> <!-- style of the header -->
	<link href="../css/style_menu_users.css" media="all" rel="stylesheet" type="text/css"/> <!-- style of the menu -->
	<link href="../css/style_body_users.css" media="all" rel="stylesheet" type="text/css"/> <!-- style of the menu -->
	<link href="../css/style_footer_users.css" media="all" rel="stylesheet" type="text/css"/>  <!-- style of the menu -->
	<?php 
	include "../css/style_R_code.php";  // style of R code 
	?>

	<!-- Title, logo and description of the website -->
	<link rel="icon" type="image/png" href="../pictures/logo.png" /> 
    <title>Data Is Coming</title>
	<meta name="keywords" content="blog R sas python, maths data sql analysis dataiscoming game thrones" />
    <meta name="description" content="Data analysis blog with the thema of game of thrones" />
	
	<!-- Main title of the website -->
	<div class='header-center'>		
		<h1 id='title-header'>Data Is Coming</h1>
	</div>
	
	<!-- Use of Mathjax to write some LaTex formula -->
	<script type="text/javascript" async
	src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML">
	</script>
	
</div>