<?php

session_start(); 
if (!isset($_POST['updatemovie'])) {header ("Location:index.php");}

require_once('db.php');
$sql = "UPDATE movies SET movie_title='{$_POST['movie_title']}', movie_genre='{$_POST['movie_genre']}' WHERE movie_id='{$_POST['movie_id']}'";

if ($conn->query($sql) === TRUE) {
 $_SESSION['message']="movieupdated"; header ("Location: index.php");
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>




