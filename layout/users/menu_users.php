<!-- The menu section of the website -->
<div class='menu-section'>

   <!-- left side of the menu section - empty -->
  <div class='menu-left'></div>
  
   <!-- Menu showing the tabs of the website -->  
  <div class='menu-center'>
  <ul>
	
    <!-- tab n°1 : the home, first page seen by users --> 	
    <li><a class="tab-active" href="../users/index_users.php?page=posts">Home</a></li>

	<!-- tab n°2 : Categories, there are as many dropdowned tabs as there are categories --> 
	<div id="tab-dropdown">
	<button id="tab-dropbtn">Categories</button>
	<div id="tab-dropdown-content">
	
	<?php //Get the name of the categories from the database
		include('../database/db_open.php');
		$req = $con->prepare("SELECT * FROM categories");
		$req->execute();
		while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
			echo"<a href='../users/index_users.php?page=category&id=".$data['category']."'>".$data['category']."</a>";
		}
	?>
    </div></div>
	
	<!-- tab n°3 : About, description and purpose of the blog  --> 
    <li><a class="tab" href="../users/index_users.php?page=about">About</a></li>
	
	<!-- tab n°4 : admin link to manage the blog --> 
    <li><a class="tab" href="../admin/login/login_admin_form.php">Admin</a></li>
	</ul>
  </div>
  
  <!-- right side of the menu section - empty -->
  <div class='menu-right'></div>
  
</div>