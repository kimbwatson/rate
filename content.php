<?php 
	session_start();
	require_once('dbcon.php');
	$uid=$_SESSION['uid'];
	
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Pictures</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
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
	
 <h1 >Billeder i systemet</h1>
      <?php
		
	
	if(empty($_SESSION['uid'])){
		echo 'Du skal logge ind først<br>';
	}
	else {
		echo 'Velkommen '.$_SESSION['un'].'<br>';
	}

    
					if(filter_input(INPUT_GET, 'rate')) {
						  	
							$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) 
								or die('Missing/illegal iid parameter');
						  	$rat = filter_input(INPUT_GET, 'rat', FILTER_VALIDATE_INT) 
								or die('Missing/illegal rat parameter');
						
						
						  
						$sql = ('INSERT INTO rating (rating_val, images_id, users_id) VALUES (?,?,?)');
						$stmt = $link->prepare($sql);
						$stmt->bind_param('iii', $rat , $id , $uid);
						$stmt->execute();
							echo '<a class="center output">Dit rating '.$rat.' for billede '.$id.' er indsendt</a>';
					
						
}
	
						$sql = 'SELECT AVG(rating_val) as gennemsnit FROM rating WHERE images_id=?';
						$stmt = $link->prepare($sql);
						$stmt->bind_param("i", $id);
						$stmt->execute();
						$stmt->bind_result($gennem);
						while($stmt->fetch()){
							}
						
	
	
					if(filter_input(INPUT_POST, 'del')){

						$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) 
							or die('Missing/illegal iid parameter');

						$sql = 'DELETE FROM images WHERE images_id=?';
						$stmt = $link->prepare($sql);
						$stmt->bind_param('i', $id);
						$stmt->execute();

					if($stmt->affected_rows > 0){
						echo 'Deleted image number '.$id;
					}
					else {
						echo 'Could not delete image number '.$id;
					}
					}

						$sql = 'SELECT images_id, title, imageurl, users_id FROM images ORDER BY last_update DESC';
						$stmt = $link->prepare($sql);
						$stmt->execute();
						$stmt->bind_result($id, $title, $url, $uid);

						while($stmt->fetch()){ 

	?>
			    <div class="output1 center"> 
                <table  border="0" width="100%" >
				<tr>
					<td  width="20px">
								<form action="<?=$_SERVER['PHP_SELF']?>" metod="get">
								<input type="hidden" name="id" value="<?=$id?>"/>
								<input type="radio" name="rat" value="1">1 stjerne<br>
								<input type="radio" name="rat" value="2">2 stjerner<br>
								<input type="radio" name="rat" value="3">3 stjerner<br>
								<input type="radio" name="rat" value="4">4 stjerner<br>
								<input type="radio" name="rat" value="5">5 stjerner<br>
										<button name="rate" type="submit" value="rate">Rate</button>
										
								</form>
						
					</td>
					<td  width="200px" align="center" valign="top">
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post"><?=$id?> : <?=$title?> : <br> <img src="<?=$url?>" width=300px ;/><br>
								<input type="hidden" name="id" value="<?=$id?>"/>
								<input type="hidden" name="id" value="<?=$rat?>"/>
								<input type="hidden" name="id" value="<?=$gennem?>"/>
										<button name="del" type="submit" value="del">Delete</button><br>
												<p>Det nye gennemsnit er : <?=$gennem?></p>
								
								
				</form>
						
					</td>
				</tr>
				
			</table>
	  	</div>
	<?php
						
						
		
						}
				

?>			
  </div>
  		
</body>
</html>