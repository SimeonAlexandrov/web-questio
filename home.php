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
			 echo "<div id='form-container'><form action='ask.php' id='question-form' method='POST' onsubmit='return askQuestion(this);'>
			  <input type='text' name='question' id='question-value' required='required' placeholder='Ask anything about world cup' /> <br/>
			 <input type='submit' value='Ask'/>
		  </form></div>";
			echo "<div id=\"history\">
					<script>showHistory()</script>
				</div>";
		 } elseif  ($role == 'operator'){
			echo '<div>Choose a question to answer</div>';
		 }
		?>
		

    </body>
</html>