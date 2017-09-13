<?php 
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="stylesheet.css">
<title>Login</title>
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
		<fieldset>
			<legend>Login</legend>
				<input class="un" name="un" type="username" placeholder="Brugernavn" required/>
				<input class="pw" name="pw" type="password" placeholder="Password" required/>
				<input class="knap" name="submit" type="submit" value="Login"/>
			
		</fieldset>
		
		
	</form>
    </div>
	<?php
	if(filter_input(INPUT_POST, 'submit')) {
		$un = filter_input(INPUT_POST, 'un') 
			or die('<div class="output">Mangler brugernavn - prøv igen <br><a href="opret.php">Eller opret ny bruger</a></div>');
		$pw = filter_input(INPUT_POST, 'pw') 
			or die('<div class="output">Mangler password- prøv igen <br><a href="opret.php">Eller opret ny bruger</a></div>');
		
		require_once('dbcon.php');
		
		$sql = 'SELECT user_id, pwhash FROM users where un=?';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('s', $un);
		$stmt->execute();
		$stmt->bind_result($uid, $pwhash);
		
		while($stmt->fetch()) {}
		
		
	if(password_verify($pw,$pwhash)) {
		echo '<div class="output">Logget ind som <br>'.$un.'</div>';
		$_SESSION['uid']=$uid;
		$_SESSION['un']=$un;
		echo '<div class="output"><a href="uploadpic.php">Gå til content</a><br><a href="update.php">Update oplysning</a></div>';
	}
	else {
		echo '<div class="output">Login mislykkedes - prøv igen <br><a href="opret.php">Eller opret ny bruger</a></div>';
	}
	}
	
	?>
	
</div>
</body>
</html>