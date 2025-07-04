<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container"><div class="row"><div class="col-md-12">
<h1>Search Movie Database</h1>

<form action="search.php" method="get">
    Enter Search Term <input type="text" name="searchterm" required><br>
    <button type="submit" name="dosearch" class="btn btn-warning">Search</button>
</form>
<table class="table table-hover table-striped table-bordered">
<tr>
<th>Rank</th>
<th>Title</th>
<th>lifetime Gross</th>
<th>Year</th>
</tr>
<?php
if(isset($_GET['dosearch'])){
 echo '<h2>Search Results</h2>';  
require ('db.php');

$sql = "SELECT * FROM top_grossing_movies WHERE title LIKE '%{$_GET['searchterm']}%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?=$row['rank']?></td>
<td><?=$row['title']?></td>
<td>$<?=$row['lifetime_gross']?></td>
<td><?=$row['year']?></td>
</tr>

<?php
  }
} else {
  echo "0 results";
}
$conn->close();


}
?>
</table>



 </div></div></div>   
</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>