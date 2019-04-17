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
				
					// Loop to show every categories
					while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
						echo "<center>".$data['id_cat']." ".$data['category']."</center><br/>";
					}
				}
				?>
			
				<!-- Form for the name of the new category -->
				<form action="add_category_action.php" method="post">
					<center>
						Add a Category : <br/>
						<input type="text" name="category_new" size="30" /><br />
						<input type="submit" name="action" value="Send" /> -
						<input type="reset" value="Cancel" />         
					</center>
				</form>
			</div>
		</div>
	</body>
</html>
