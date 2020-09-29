<html>
	<body>
		
		<?php
		// Header and menu sections for the admin
		include('../../layout/admin/header_admin.php'); 
		include('../../layout/admin/menu_admin.php');
		?>
		
		<div id="index_admin">
			<div id="commentaire">
				
				<!-- Form for the title and corpus of the new article -->
				<form action="new_post_action.php" method="post">
					<center>
						Title : <br/>
						<input type="text" name="title_new" size="60" /><br />
						Abstract :<br/>
						<textarea name="abstract_new" cols="150" rows="5" id="com"/></textarea><br>
						Corpus :<br/>
						<textarea name="corpus_new" cols="150" rows="30" id="com"><?php echo "<p align='justify'></p>" ?></textarea><br>
						<?php
						// Connexion to the database 
						include('../../database/db_open.php');
				
						// Query to select the number max of post to add a post just in N+1
						$query = $con->prepare("select * from categories");
						$query->execute();
				
						// Condition : the query worked well
						if($query==TRUE){
				
							// Loop to show a checkbox for each category in the database
							while ($data= $query ->fetch(PDO::FETCH_ASSOC)){
								echo"<input type='checkbox' name='category[]' value=".$data['id_cat']." /><label for=".$data['id_cat'].">".$data['category']."</label><br />";
							}
						}
						?>
						<select name="status_post" id="status_post">
							<option value="saved">Saved</option>
							<option value="published">Published</option>
						</select> -
						<input type="submit" name="action" value="Preview" formtarget="_blank" /> - 
						<input type="submit" name="action" value="Send" /> -
						<input type="reset" value="Cancel" />         
					</center>
				</form>
			</div>
		</div>
	</body>
</html>
