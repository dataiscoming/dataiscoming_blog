<html>
	<body>
		
		<!-- Header and menu section for the admin panel -->
		<?php include('../../layout/admin/header_admin.php') ?>
		<?php include('../../layout/admin/menu_admin.php') ?>
		
		<div id="index_admin">
			<div id="commentaire">
				
				<?php
				// Connexion to the database
				include('../../database/db_open.php');
				
				// Query to select all the categories
				$req = $con->prepare("SELECT * FROM categories");
				$req->execute();
		
				// Condition : the query worked well
				if($req==TRUE){
					
					$count = 1;
					echo "<center><table><tr>";
				
					// Loop to show every categories
					while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
						echo "<td>".$data['id_cat']."</td><td>".$data['category']."</td>";
						
						if($count%4==0){
							echo "</tr><tr>";
						}
						$count = $count+1;
						
					}
					
					echo "</tr></table></center></br>";
				}
				?>
			
				<!-- Form for the name of the new category -->
				<form action="add_category_action.php" method="post">
					<center>
						Add a Category : <br/>
						<input type="text" name="category_new" size="30" /></br></br>
						<input type="submit" name="action" value="Send" /> -
						<input type="reset" value="Cancel" />         
					</center>
				</form>
			</div>
		</div>
	</body>
</html>
