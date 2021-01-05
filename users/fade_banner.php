<?php 
// If there is a click on the banner, the banner fade and the cookie is change to not allow the banner to show up again until the cookie is finished

// Get the cookie bottom banner 
$_SESSION['bottom_banner'] = "no_show";

// Set the new value of the cookie bottom banner
setcookie("bottom_banner", "no_show", time()+3600);

// Send the result variable to JS to fade the banner
if($_SESSION['bottom_banner'] == "no_show" | isset($_COOKIE['bottom_banner'])){
	echo "Success"; 
}else{
	echo "Failed"; 
} 
?>
