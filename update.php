<?php 
	session_start();
?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Ændre oplysninger</title>
<link rel="stylesheet" href="stylesheet.css">
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
		<form class="center output" action="<?=$_SERVER['PHP_SELF'] ?>" method="post">
		<fieldset class="style">
			<legend>Nye oplysninger</legend>
				<input class="un" name="un" type="username" placeholder="Brugernavn" required/>
				<input class="pw "name="pw" type="password" placeholder="Password" required/>
				<input class="knap" name="submit" type="submit" value="Ændre bruger"/>
			
		</fieldset>
		
		
	</form>
	</p>
	<?php
		$uid=$_SESSION['uid'];
	
	if(filter_input(INPUT_POST, 'submit')) {
		$un = filter_input(INPUT_POST, 'un') 
			or die('<div class="output">Mangler brugernavn</div>');
		$pw = filter_input(INPUT_POST, 'pw') 
			or die('<div class="output">Mangler password</div>');
		$pw = password_hash($pw, PASSWORD_DEFAULT);
		
			echo '<div class="output">Bruger '.$un.' oprettet!<br></div>';
		
		require_once('dbcon.php');
		
		$sql = 'UPDATE users SET un = ?, pwhash = ? WHERE user_id = ?;';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('ssi', $un, $pw, $uid);
		$stmt->execute();
			if($stmt->affected_rows > 0){
				echo '<div class="output"><a href="login.php">Gå til loginside</a></div>';
			}
				else {
					echo '<div class="output"><br>Kunne ikke oprette bruger</div>';
				}
	}
	?>
  </div>
  
</body>
</html>