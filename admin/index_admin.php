<html> 
	
	<?php 
		// Header section for the admin
		include('../layout/admin/header_admin_index.php')
	?>
	
	<body>
		
		<?php 
			// Menu section for the admin
			include('../layout/admin/menu_admin.php') 
		?>
		
		<div id="index_admin">
			<div id="big_admin">
                <?php
					// Connextion to the database
					include('../database/db_open.php');
					
					// Query to know how many posts the database have
					$req="select * from posts ";
					$stmt = $con->query($req);
					$nbr = $stmt->rowCount();	
					
					// Number of posts
					$SumPost =  $nbr;	
					
					// Check if we have at least one post
					if ($nbr >= 1){
						
						// Number of post per page
						$NumberPostPerPage = 6;
						
						// Number of page showed
						$NumberOfPage  = ceil($SumPost / $NumberPostPerPage);
						
						// Check which page is showed in the URL
						if (isset($_GET['page'])){    
							
							// We GET the number of the page in the URL					  
							$page = $_GET['page']; 
						}
						else{
							
							// It is the first time the page is seen
							$page = 1; 
						}
						
						// The number of the first post to show	
						$FirstPost = ($page - 1) * $NumberPostPerPage; 
						
						// Query selecting the posts to show according to number of post per page
						$query = $con->query('SELECT * FROM posts ORDER BY id DESC LIMIT ' . $FirstPost . ', ' . $NumberPostPerPage);
						define('DIR', 'upload/');
						
						// loop : produce a html code for each of the post
						while ($data=$query->fetch(PDO::FETCH_ASSOC)){
							
						?>
						<div class="block_admin">
							<div class="left">
								<div class="tout">
								</div>
								
								<!-- Title division -->
								<div class="title_post_admin">
									<?php 
										// Delete the antislash of the string
										$mess = stripslashes($data['title']); 
										
										// The length max of the title
										$lg_max = 80; 
										
										// we cut the title if it is too long
										if (strlen($mess) > $lg_max){
											$mess = substr($mess, 0, $lg_max);
											$last_space = strrpos($mess, " ");
											$mess = substr($mess, 0, $last_space)."...";
										}
										// Replace of certain elements of the title
										$mess = preg_replace('#\[i\]#','<i>', $mess);
										$mess = preg_replace('#\[\/i\]#','</i>', $mess);
										$mess = preg_replace('#\[s\]#','<u>', $mess);
										$mess = preg_replace('#\[\/s\]#','</u>', $mess);
										$mess = preg_replace('#\[strike\]#','<strike>', $mess);
										$mess = preg_replace('#\[\/strike\]#','</strike>', $mess);
										$mess = preg_replace('#&lt;#','<', $mess);
										$mess = preg_replace('#&quot;#','"', $mess);
										$mess = preg_replace('#&gt;#','>', $mess);
										/*show title */
										echo $mess;
									?>
								</div>
								
								<!-- Indication of the date and time of creation and modification -->
								<div class="normale">
									Created the <?php echo date('d/m/Y  H\hi', $data['timestamp']); 
										if($data['timestamp_modif'] != 0){
										?> and modified the <?php echo date('d/m/Y ', $data['timestamp_modif']); ?> &agrave; 
										<?php echo date('H\hi', $data['timestamp_modif']); }
										else{
										} 
									?></div>
									
							</div>
							<div class="supprmodif">
								<!-- Deleting link -->
								<a href="javascript:confirmation_suppr('post/delete_article.php?id=<?php echo $data['id']; ?>');">Delete</a><br />
								
								<!-- Modification link -->
								<a href="../admin/post/modify_article_form.php?id=<?php echo $data['id']; ?>">Modify</a>
								<br>
								<?php  echo $data['status_post']; ?>
								<br>
							</div>
						</div>
						<br />
						<?php
						}
						
						// Selection of the number of the page
						echo "<div class=\"block_admin_bas\"><center>";
						for ($i = 1 ; $i <= $NumberOfPage ; $i++){
							echo '<span class="lien"><a href="index_admin.php?page=' . $i . '">' . $i . '</a></span> ';
						}
						echo "</center></div>";
					}
					else{
						
						// Message indicating that there is not post written yet
						echo '<div class="aucunarticle">'; echo 'You do not have any articles published in your blog.'; echo '</div>';
					}
				?>
			</div>
			
			<!-- Indication of the number of post online -->
			<div id="backgroundbleu">
				<?php if($nbr>1) {$s="s";} else {$s="";} ?>
				<div class="lien_menu"><a href="index_admin.php"><strong><?php echo $nbr; ?></strong> article<?php echo $s; ?> online</a></div>
			</div>
			
		</div>
	</body>
</html>																																															