<link rel="stylesheet" href="../css/base.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/media-queries.css">  
   
<!-- Header
=================================================== -->
<header id="main-header">
   
    <div id="log"></div>

   	<div class="row header-inner">

	    <div class="logo">
	        <a class="smoothscroll" href="../users/index_users.php#hero" onclick="SendEvent(LINK='../users/index_users.php#hero', ELEMENT = 'logo_header')">
				<img src="../pictures/logo.png">
			</a>
	    </div>

	    <nav id="nav-wrap">         
	         
	        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">
				<span class='menu-text'>Show Menu</span>
	         	<span class="menu-icon"></span>
	        </a>
         	<a class="mobile-btn" href="#" title="Hide navigation">
         		<span class='menu-text'>Hide Menu</span>
         		<span class="menu-icon"></span>
         	</a>         

	        <ul id="nav" class="nav">
				<?php 
				$Link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'];
				if(strpos($Link, 'single') == TRUE){ ?>
					<li onclick="SendEvent(LINK='../users/index_users.php#hero',ELEMENT='menu_hero')"><a>Home.</a></li>	
					<li class="current" onclick="SendEvent(LINK='../users/index_users.php#journal',ELEMENT='menu_journal')"><a>Blog.</a></li>	
				<?php }else{ ?>
					<li data-id="hero" class="current" onclick="SendEvent(LINK='../users/index_users.php#hero',ELEMENT='menu_hero')"><a>Home.</a></li>
					<li data-id="journal" class="" onclick="SendEvent(LINK='../users/index_users.php#journal',ELEMENT='menu_journal')"><a>Blog.</a></li>
				<?php } ?>			
							
	        </ul> 

	    </nav> <!-- /nav-wrap -->	      

	</div> <!-- /header-inner -->

</header>