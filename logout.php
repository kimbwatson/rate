<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
?>
<!doctype html>
<html><head>
<link rel="stylesheet" href="stylesheet.css">
<meta charset="UTF-8">
<title>Log ud</title>
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

<div class="center output">Du er nu logget ud <br> <a href="login.php">Gå til login-side</a></div>
  </div>
</body>
</html>