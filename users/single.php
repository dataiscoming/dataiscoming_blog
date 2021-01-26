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

	<?php // Import the Headers common to the index users and single screens
	include('../layout/users/global_header_users.php');
	?>

<body>

	<div id="top"></div>

	<?php // Import the preloader screen
	include('../layout/users/preloader_users.php');
	?>

	<?php // Import the headers for the users screen
	include('../layout/users/header_users.php');
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
   
   	<?php // Set the style for R code in posts
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

						<!-- Show the title of the post -->
						<h1 class="entry-title">
							<?php echo $data['title']; ?>
						</h1> 				 
						
						<div class="entry-meta">
							<ul>
								<!-- Show the date of the post -->
								<li><?php echo date('d/m/Y ', $data['timestamp']); ?></li>
								<span class="meta-sep">•</span>			
								<?php // Show the tags of the post 
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
					<!-- Show the corpus of the post -->	
					<?php echo nl2br($data['corpus']); ?>	
						
					</div> 
						
	  			   </p>

	  			   <div class="pagenav group">
				   <?php // Show the navigation panel to previous post
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

				<div> <!--comment-->
				
				<?php
				// Query to select the post identified thanks to the variable id_post
				$req = $con->prepare("SELECT *
				FROM comments 
				WHERE ID_post=:id_post 
				ORDER BY order_reply");
				$req->bindValue('id_post', $id_post, PDO::PARAM_STR);
				$req->execute();
				
				if($req == TRUE){
					$count = $req->rowCount();
				} else {
					echo("Issue in the query !");
				}
				?>
				
					<?php // Count of the number of comments
					if($count > 1){
						echo("<h3>".$count." Comments</h3>");
					} else if($count == 1){
						echo("<h3>1 Comment</h3>");
					} else{
						echo("<h3>No Comment yet</h3>");
					}
					?>
				
					<ol class="commentlist">
					
					<?php
					// Loop to show all comment for this post
					while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
						
						// Condition to open a reply
						if($data['level_reply'] > 1){
							echo("<ul class='children'>");
						}
						
						// Comment
						echo("<li class='depth-".$data['level_reply']."'> 

								<div class='comment-content'>

									<div class='comment-info'>
										<cite>".$data['user_name']."</cite>

										<div class='comment-meta'>
											<time>".$data['date_comment']." </time>@<time> ".$data['time_comment']."</time>
											<span class='sep'>/</span><a href='single.php?id_post=".$id_post."&max=".$data['max_reply']."&level=".$data['level_reply']."&order=".$data['order_reply']."&previous=".$data['id_comment']."#comment' class='reply'>Reply</a>
										</div>
									</div>

									<div class='comment-text'>
										<p>".$data['text_comment']."</p>
									</div>

								</div>
							
							</li>");

						// condition to close the reply
						if($data['level_reply'] == $data['max_reply'] & $data['level_reply'] > 1){
							for($i = 1; $i < $data['max_reply']; $i++){
								echo("</ul>");
							}	
						}
					}
					?>
						
					</ol>
				
					<!-- respond -->
					<div id="comment" class="respond">

						<h3>Leave a Comment</h3>
						
						<!-- form -->
						<form action="comment.php" method="post" id="contactForm" name="contactForm">
							<fieldset>

							<div class="group">
	  						   <label for="cName">Name <span class="required_field">*</span></label>
	  						   <input class="required" type="text" value="" size="70" id="cName" name="cName">
							</div>

							<div class="group">
	  						   <label for="cEmail">Email <span class="required_field">* </span></label>
	  						   <input class="required" type="email" value="" size="70" id="cEmail" name="cEmail" required>
							</div>

							<div class="website_group">
	  						   <label for="cWebsite">Website</label>
	  						   <input type="text" value="" size="70" id="cWebsite" name="cWebsite">
							</div>

							<div class="group">
								<label for="cMessage">Message <span class="required_field">*</span></label>
								<!--<input class="required" type="text" value="" size="80" id="cMessage" name="cMessage">-->
								<textarea  class="required" cols="80" rows="10" id="cMessage" name="cMessage"></textarea>
							</div>

							<?php
							if(isset($_GET['max']) & isset($_GET["level"]) & isset($_GET["order"])){
							?>
							<input type="hidden" id="max" name="max" value=<?php echo $_GET['max'];?> >
							<input type="hidden" id="level" name="level" value=<?php echo $_GET["level"];?> >
							<input type="hidden" id="order" name="order" value=<?php echo $_GET["order"];?> >
							<input type="hidden" id="id_previous_comment" name="id_previous_comment" value=<?php echo $_GET["previous"];?> >
							<?php } ?>
							<input type="hidden" id="id_post" name="id_post" value=<?php echo $id_post;?> >
							<label><span class="required_field">* : required</span></label>
							<button id="comment_form" class="comment_form_disabled" type="submit" name="action" value="Send" disabled="disabled">Submit</button>
								<!-- class="stroke medium" style="background-color:#cadde1"-->
	  					</fieldset>
						
	  				   </form> <!-- /contactForm -->

					</div> <!-- /respond -->

				</div> <!-- /comments -->

			</article> <!-- /entry -->							   
	         
	   	</div> <!-- /main -->  

	    <div class="tab-whole four columns end" id="secondary">
				
			<aside id="sidebar">
	        </aside> <!-- /sidebar -->	            

	    </div> <!-- /secondary -->

	   </div> <!-- /row -->      

   </section> <!-- /content --> 

	<?php // Import the footer links
	include('../layout/users/footer_users.php');
	?>
	
	<?php // Import the cookie banner always seen if not closed
	include('../layout/users/Cookie_banner.php');
	?>

</body>

</html>