<?php
session_start();
if (!(isset($_POST['deletemovie']))) {header ("Location:index.php"); exit;}
require_once ('db.php');

$sql = "DELETE FROM movies WHERE movie_id='{$_POST['movie_id']}'";



if ($conn->query($sql) === TRUE) {
  $_SESSION['message']="moviedeleted";
  header ("Location: index.php");
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>



?>