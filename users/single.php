<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

	<?php
	include('../layout/users/global_header_users.php');
	?>

<body>

	<div id="top"></div>

	<?php
	include('../layout/users/preloader_users.php');
	?>

	<?php
	include('../layout/users/header_users_single.php');
	?>


   <!-- Page Title
   ================================================== -->
   <section id="page-title">	
   	  
		<div class="row">

			<div class="twelve columns">

				<h1>Data is coming<span>.</span></h1>
				<p>a blog about Game Of Thrones and data science</p>

			</div>			    

		</div> <!-- /row -->	   

   </section> <!-- /page-title -->


   <!-- Content
   ================================================== -->
   
   	<?php
	include('../css/style_R_code.php');
	?>
   
   <?php
	// Connexion to the database
	include('../database/db_open.php');

	// Setting the variable to identify the post chosen
    $id_post = $_GET['id_post'];
          
	// Query to select the post identified thanks to the variable id_post
	$req = $con->prepare("SELECT * FROM posts WHERE ID=:id_post");
	$req->bindValue('id_post', $id_post, PDO::PARAM_STR);
	$req->execute();
	$data= $req ->fetch(PDO::FETCH_ASSOC);
	
	?>
   
   <section id="content">

   	<div class="row">

	   	<div id="main" class="tab-whole eight columns">

	         <article class="entry">

					<header class="entry-header">

						<h1 class="entry-title">
							<?php echo $data['title']; ?>
						</h1> 				 
						
						<div class="entry-meta">
							<ul>
								<li><?php echo date('d/m/Y ', $data['timestamp']); ?></li>
								<span class="meta-sep">•</span>			
								<?php 
								$req = $con->prepare("
								SELECT t3.*
								FROM 
								posts as t1,
								link_category_post as t2,
								categories as t3
								where 
								t3.id_cat = t2.id_postcat and 
								t2.id_post = t1.id and 
								t1.id =:id_post");
								$req->bindValue('id_post', $_GET["id_post"], PDO::PARAM_STR);
								$req->execute();	
						
								while ($data2= $req ->fetch(PDO::FETCH_ASSOC)){ 
								echo "<li><a rel='category tag' title='' href='#'>".$data2['category']."</a></li>";
								}
								?>
								<span class="meta-sep">•</span>
								<li>Quentin Mouton</li>
							</ul>
						</div> 
						 
					</header>
						
					<div class="entry-content">
						
					<?php echo nl2br($data['corpus']); ?>	
						
					</div> 
						
	  			   </p>

	  			   <div class="pagenav group">
				   <?php 
						$req = $con->prepare("
						SELECT t1.id
						FROM 
						posts as t1
						ORDER BY id DESC LIMIT 1
						");
						$req->execute();	
						
						$data= $req ->fetch();
						$id_post = $_GET['id_post'];
						$one = (int)1;
						$id_plus = (int)$id_post+$one;
						$id_minus = (int)$id_post-$one;
						
						if($id_post == $data['id']){
							echo "<span class='prev'><a href=single.php?id_post=".$id_minus." rel='prev'>Previous</a></span>";
						} elseif($id_post == 1){
							echo "<span class='next'><a href=single.php?id_post=".$id_plus." rel='next'>Next</a></span>"; 
						} else {
							echo "<span class='prev'><a href=single.php?id_post=".$id_minus." rel='prev'>Previous</a></span>";
							echo "<span class='next'><a href=single.php?id_post=".$id_plus." rel='next'>Next</a></span>"; 
						}
						
					?>
		  			     				   
	  				</div>  

				</article> <!-- /entry -->							   
	         
	   	</div> <!-- /main -->  

	      <div class="tab-whole four columns end" id="secondary">
				
			<aside id="sidebar">
	        </aside> <!-- /sidebar -->	            

	      </div> <!-- /secondary -->

	   </div> <!-- /row -->      

   </section> <!-- /content --> 

	<?php
	include('../layout/users/footer_users.php');
	?>

</body>

</html>