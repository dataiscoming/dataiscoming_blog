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
				$sql2="
				SELECT t3.category
				FROM posts as t1, 
				link_category_post as t2,
				categories as t3 
				WHERE 
				t1.id = t2.id_post AND
				t2.id_postcat = t3.id_cat AND
				t1.id = '".$id."'";
				$cat = $con->query($sql2);
				$data2=$cat->fetchAll(PDO::FETCH_ASSOC);	
				$data2 = array_column($data2, 'category');
			}
		?>
		
		<div id="index_admin">
			<!-- Form to get the new value of the post -->
            <form action="modify_article_action.php" method="post">
				<center>
					<br>
					Title : <br>
					<input type="text" name="title_modif" value="<?php  echo $data['title']; ?>" size="60"><br />
					Abstract :<br/>
					<textarea name="abstract_modif" cols="150" rows="5" id="com"/><?php echo $data['abstract']?></textarea><br>
					Corpus :<br/>
					<textarea name="corpus_modif" cols="150" rows="30" id="commentaire"><?php echo $data['corpus'];?></textarea></br></br>
					<select name="status_post" id="status_post">
						<?php
						/* Check what was the status of the post before and show it*/
						if($article==True & $data['status_post']=='published'){ 
							echo "<option value='saved'>Saved</option>";
							echo "<option value='published' selected>Published</option>";
						}else{
							echo "<option value='saved' selected>Saved</option>";
							echo "<option value='published'>Published</option>";
						}
						?>
					// </select></br></br>
					<?php
					include('../../database/db_open.php');
					/* Select the number max of post to add a post just in N+1 */
					$req = $con->prepare("select * from categories");
					$req->execute();

					if($req==TRUE){
						$count = 1;
						echo "<table><tr>";
						while ($data3 = $req ->fetch(PDO::FETCH_ASSOC)){
							if(in_array($data3['category'],$data2,true)){
								echo"<td><label for=".$data3['id_cat'].">".$data3['category']."</label></td>
								<td><input type='checkbox' name='category[]' value=".$data3['id_cat']." checked/></td>";
							} else {
								echo"<td><label for=".$data3['id_cat'].">".$data3['category']."</label></td>
								<td><input type='checkbox' name='category[]' value=".$data3['id_cat']."/></td>";
							}
							if($count%4==0){
								echo "</tr><tr>";
							}
							$count = $count+1;
						}
						echo "</tr></table></br>";
					}
					?>
					<!--<input type="submit" name="action" value="Preview" formtarget="_blank"/> - -->
					<input type="hidden" name="id_modif" value="<?php  echo "$id"; ?>">
					<input type="submit" name="action" value="Send" /> - <input type="reset" value="Cancel" />         
				</center>
			</form>
		</div>
	</body>
</html> 
