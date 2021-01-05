<?php //Save the click into database and return a result to JS to go to the target of the link
// Connexion to the database
include('../database/db_open.php');

// Get the variables send from JS for this click
$id_session = $_POST['id_session'];
$event = $_POST['event'];
$date = $_POST['date'];
$time = $_POST['time'];
$link = $_POST['link'];
$element_event = $_POST['element_event'];

// Send the query to the DB 
$query = $con->prepare("INSERT INTO events (id_session, event, date_event, time_event, link_event, element_event) VALUES(:id_session, :event, :date_event, :time_event, :link_event, :element_event)");
$query->bindValue('id_session', $id_session, PDO::PARAM_STR);
$query->bindValue('event', $event, PDO::PARAM_STR);
$query->bindValue('date_event', $date, PDO::PARAM_STR);
$query->bindValue('time_event', $time, PDO::PARAM_STR);
$query->bindValue('link_event', $link, PDO::PARAM_STR);
$query->bindValue('element_event', $element_event, PDO::PARAM_STR);
$query->execute();

// Send a result to JS : sucess if the query is well send to the DB
if($query == TRUE){
	echo "Succes"; 
}else{
	echo "Failed"; 
} 

// Close the connexion to the DB
include('../database/db_close.php');
?>