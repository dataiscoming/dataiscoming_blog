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
			// Connection to the database and get all the posts
			include('../database/db_open.php');
	
			// Number of posts in the pages 
			$PostPerPage = 5;
			
			// Query to count the number of post with the status published
			$query="select * from posts where status_post='published' "; 
			$stmt = $con->query($query);				  
			$totalPosts = $stmt->rowCount();
			$PageNumber  = ceil($totalPosts / $PostPerPage);
			
			$page = 1;
			
			if (isset($_GET['n'])){                    
				$page = $_GET['n'];
			}else{ 
				$page = 1;
			}	
			
			// 
			$FirstMessage = ($page - 1) * $PostPerPage; 
						
			// Get the posts selected
			$req = $con->prepare("SELECT * FROM posts where status_post=:status ORDER BY id DESC LIMIT :FirstMessage , :PostPerPage");
			$req->bindValue('status', 'published', PDO::PARAM_STR);
			$req->bindValue('FirstMessage', $FirstMessage, PDO::PARAM_INT);
			$req->bindValue('PostPerPage', $PostPerPage, PDO::PARAM_INT);
			$req->execute();
			
			while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
			
			?>
			<article class="bgrid">
						
				<h5><?php echo date('d/m/Y ', $data['timestamp']); ?></h5>
	            <h3><a href="single.php?id_post=<?php echo $data['id'] ?>"><?php echo $data['title'] ?> </a></h3>
	                              
	            <p>
				<?php 
				#$mess = nl2br($data['corpus']);	
				#echo substr($mess,0,strpos($mess, '.',100));
				$mess = nl2br($data['abstract']);
				echo "<p justify='align'>".$mess."</p>";
				?>
	            </p>
	                        
	        </article>
			<?php
			}
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