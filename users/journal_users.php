   <!-- journal
   =================================================== -->
   <section id="journal" data-id="journal" class="section">

	   <div class="row section-head">

	   	<div class="twelve columns">

			   <h1>The latest posts<span>.</span></h1>

			   <hr />       

		    </div>

	   </div>

      <div class="row">

      	<div class="twelve columns">

	         <div id="blog-wrapper" class="bgrid-third s-bgrid-half mob-bgrid-whole group">

			<?php
			// Connection to the database
			include('../database/db_open.php');
	
			// Number of posts in the pages 
			$PostPerPage = 5;
			
			// Query to count the number of post with the status published
			$query="select * from posts where status_post='published' "; 
			$stmt = $con->query($query);				  
			$totalPosts = $stmt->rowCount();
			$PageNumber  = ceil($totalPosts / $PostPerPage);
			
			// Set the actual page to 1
			$page = 1;
			
			// Change the value of the page if it was changed earlier
			if (isset($_GET['n'])){                    
				$page = $_GET['n'];
			}else{ 
				$page = 1;
			}	
			
			// Select the first message to be shown
			$FirstMessage = ($page - 1) * $PostPerPage; 
						
			// Get the posts selected
			$req = $con->prepare("SELECT * FROM posts where status_post=:status ORDER BY id DESC LIMIT :FirstMessage , :PostPerPage");
			$req->bindValue('status', 'published', PDO::PARAM_STR);
			$req->bindValue('FirstMessage', $FirstMessage, PDO::PARAM_INT);
			$req->bindValue('PostPerPage', $PostPerPage, PDO::PARAM_INT);
			$req->execute();
			
			// Loop to show every message of the page
			while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
			
			?>
			<article class="bgrid">
					
				<!-- Show the date of the article -->			
				<h5><?php echo date('d/m/Y ', $data['timestamp']); ?></h5>
				
				<!-- Show the title of the post - link to the post -->
	            <div onclick="SendEvent(LINK='../users/single.php?id_post=<?php echo $data['id'] ?>', ELEMENT='<?php echo $data['id'] ?>')">
					<h3><a class="pointer"><?php echo $data['title'] ?></a></h3>
				<div>
	            <p>
				<?php 
				// Show the abstract of the post
				#$mess = nl2br($data['corpus']);	
				#echo substr($mess,0,strpos($mess, '.',100));
				$mess = nl2br($data['abstract']);
				echo "<p justify='align'>".$mess."</p>";
				?>
	            </p>
	                        
	        </article>
			<?php
			} // End of the loop showing the abstract of the posts
			?>      

	         </div> <!-- /blog-wrapper -->

			<?php
			
			echo "<center>";
			for ($i = 1 ; $i <= $PageNumber ; $i++){
				echo '<a href="../users/index_users.php?n='.$i.'#journal">'.$i.' </a>';
			}
			echo "</center>";
			?>  


	      </div> <!-- /twelve -->

      </div> <!-- /row -->

   </section> <!-- /blog -->