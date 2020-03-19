<html>
	<body>
		<?php
			/* Header and Menu parts for the admin */
			include('../../layout/admin/header_admin.php'); 
			include('../../layout/admin/menu_admin.php');
			
			/* Condition rejecting the empty ID */
			if(isset($_GET['id'])){
				
				/* Variables new ID*/
				$id=$_GET['id'];
				
				/* Connextion to the database */
				include('../../database/db_open.php');
				
				/* Get the actual status of the post */
				$sql="SELECT * FROM posts WHERE id='".$id."'";
				$article = $con->query($sql);
				$data=$article->fetch(PDO::FETCH_ASSOC);
        
				/* Get the actual catgories of the post */
				$sql2="SELECT * FROM posts categories";
				$article2 = $con->query($sql2);
				$data2=$article2->fetch(PDO::FETCH_ASSOC);
			}
		?>
		
		<div id="index_admin">
			<!-- Form to get the new value of the post -->
            <form action="modify_article_action.php" method="post">
				<center>
					<br>
					Title : <br>
					<input type="text" name="title_modif" value="<?php  echo $data['title']; ?>" size="30"><br />
					Corpus :<br/>
					<textarea name="corpus_modif" cols="80" rows="20" id="commentaire"><?php echo $data['corpus'];?></textarea><br>
					<select name="status_post" id="status_post">
							<option value="saved">Saved</option>
							<option value="published">Published</option>
						</select> -
					<?php
				include('../../database/db_open.php');
				/* Select the number max of post to add a post just in N+1 */
			$req = $con->prepare("select * from categories");
			$req->execute();
			if($req==TRUE){
			while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
			echo"<input type='checkbox' name='category[]' value=".$data['id_cat']." /><label for=".$data['id_cat'].">".$data['category']."</label><br />";
			}}
	?>
					<!--<input type="submit" name="action" value="Preview" formtarget="_blank"/> - -->
					<input type="hidden" name="id_modif" value="<?php  echo "$id"; ?>">
					<input type="submit" name="action" value="Send" /> - <input type="reset" value="Cancel" />         
				</center>
			</form>
		</div>
	</body>
</html> 
