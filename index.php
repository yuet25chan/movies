<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<title>Movies</title>
</head>
<body>
<div class="container"><div class="row"><div class="col-md-12">
<h1>Movies</h1>
<?php
if (isset($_SESSION['message'])) {
    if ($_SESSION['message']== 'movieadded')
    {echo '<div class="alert alert-success">
  <strong>Success!</strong> Movie added to the database.
</div>';} 

 elseif($_SESSION['message']== 'moviedeleted')
    {echo '<div class="alert alert-danger">
  <strong>Success!</strong> Movie deleted from the database.
</div>';} 

elseif($_SESSION['message']== 'movieupdated')
    {echo '<div class="alert alert-info">
  <strong>Success!</strong> Movie updated.
</div>';} 

unset($_SESSION['message']);
}


if (isset($_POST['editmovie'])){ ?>
<form action="updatemovie.php" method="post" style="margin-top:50px; margin-bottom:50px;">
  
<div class="form-group">
<label>Movie Title:</label>
<input type="text" class="form-control" name="movie_title" value="<?=$_POST['movie_title']?>">
  </div>
  
<div class="form-group">
<label>Movie Genre:</label>
<select class="form-control" name="movie_genre">

  <?php
  
$movies=array ("Action","Comedy","Kids and Family", "Drama","Fantasy","Horror","Mystery","Romance","Thriller","Western");
foreach ($movies as $movie) 
{echo '<option value="' . $movie . '"';
if ($movie == $_POST['movie_genre']){echo 'selected'; }
echo '>'.$movie.'</option>';

}

?>
    
  </select>
</div>
<input type="hidden" name="movie_id" value="<?=$_POST['movie_id']?>">
  <button type="submit" class="btn btn-success" name="updatemovie">Update  Movie</button>
</form>
<?php
}
else {
?>

    
<form action="insertmovie.php" method="post" style="margin-top:50px; margin-bottom:50px;">

<div class="form-group">
<label>Movie Title:</label>
<input type="text" class="form-control" name="movie_title">
  </div>
  
<div class="form-group">
<label>Movie Genre:</label>
<select class="form-control" name="movie_genre">

  <?php
  
$movies=array ("Action","Comedy","Kids and Family", "Drama","Fantasy","Horror","Mystery","Romance","Thriller","Western");
foreach ($movies as $movie) {echo '<option value="'.$movie.'">'.$movie.'</option>';}

?>
    
</select>
</div>
  <button type="submit" class="btn btn-success" name="addmovie">Submit</button>
</form>
<?php

}
?>

<table class="table table-bordered table-hove table-striped">
<tr>
<th>ID</th>
<th>Title</th>
<th>Genre</th>
<th></th>
<th></th>
</tr>
<?php
require_once('db.php');

$sql = "SELECT* FROM movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    //close out the php

    ?> 
<tr>
 <td><?=$row['movie_id']?></td>
 <td><?=$row['movie_title']?></td>
 <td><?=$row['movie_genre']?></td> 
 <td>
 <form action="deletemovie.php" method="post">
<input type="hidden" name="movie_id" value="<?=$row["movie_id"]?>">
<button type=submit name="deletemovie" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove"></span>remove</button>
</form>
</td>
<td>
<form action="index.php" method="post">
<input type="hidden" name="movie_id" value="<?=$row["movie_id"]?>">
<input type="hidden" name="movie_title" value="<?=$row["movie_title"]?>">
<input type="hidden" name="movie_genre" value="<?=$row["movie_genre"]?>">
<button type=submit name="editmovie" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-pencil"></span>edit</button>
  </form>
</td>

</tr>

<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
</table>



</div></div></div>   
</body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>


