<?php 
	session_start();
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="stylesheet.css">
<title>Put in your...</title>
</head>

<body>
  <div class="container">
<ul id="nav">
	
	
	<li><a href="logout.php">Log ud</a></li>
	<li><a href="content.php">Ratingside</a></li>
	
	<li><a href="uploadpic.php">Upload billede</a></li>
	<li><a href="opret.php">Opret bruger</a></li>
	<li><a href="login.php">Login</a></li>
</ul>
   </div>
  
  <div class="output center"> 
	<div class="center output">
	<h2>Upload nyt billede</h2>
	<form action="upload.php" method="post" enctype="multipart/form-data">
    Vælg billede:<br><br>
    	<input type="text" name="title" placeholder="Titel" required />
    	<br><br>
    	<input type="file" name="fileToUpload" id="fileToUpload"><BR><br>
    	<input type="submit" value="Upload Image" name="submit">
	</form>
    </div>
	</div>
</body>
</html>