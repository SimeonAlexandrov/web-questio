<html>
	<head>
		<title>My first PHP website</title>
		<?php
			session_start(); 
			if($_SESSION['user']){ 
			}
			else{
				header("location:index.php"); 
			}
			$user = $_SESSION['user']; 
			$role = $_SESSION['role'];
		?>
		<script src="./home.js"></script>
	</head>
	
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"." $role	"?>!</p> 
        <a href="logout.php">Click here to logout</a><br/><br/>

		<?php 
		 if ($role == 'user') {
			 echo '<form action="ask.php" method="POST">
			 Enter question: <input type="text" name="question" required="required" /> <br/>
			 <input type="submit" value="Ask"/>
		  </form>';
		 } elseif  ($role == 'operator'){
			echo '<div>Choose a question to answer</div>';
		 }
		?>
		

    </body>
</html>