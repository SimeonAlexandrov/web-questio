<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<?php
	session_start(); 
	if($_SESSION['user']){ 
	}
	else{
		header("location:index.php"); 
	}
	$user = $_SESSION['user']; 
	?>
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"?>!</p> 
        <a href="logout.php">Click here to logout</a><br/><br/>
    </body>
</html>