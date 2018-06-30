<html>
	<head>
		<title>My first PHP website</title>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="./styles/global.css">
		<script src="./home.js"></script>
		<?php 
		session_start(); 
		if($_SESSION['user']){ 
			$role = $_SESSION['role'];
			$user = $_SESSION['user'];
		}
		else{
			header("location:index.php"); 
		}
		?>
	</head>
	
	<body>
		<h2>Home Page</h2>
		<p>Hello <?php Print "$user"."  $role";?>!</p> 
        <a href="logout.php">Click here to logout</a><br/><br/>

		<?php
		require_once 'getQuestions.php'; 
		require_once 'helpers.php';
		 if ($role == 'user') {
			echo "<div id='form-container'>";
			getAskForm();
			echo'</div>';
			echo "<div id='history-container'>";
			getHistory($getQuestions);
			echo'</div>';

		 } elseif  ($role == 'operator'){
			echo "<div id='form-container'>";
			getAnswerForm($getUnansweredQuestions);
			echo'</div>';
			echo "<div id='history-container'>";
			getHistory($getPreviouslyAnsweredQuestions);
			echo'</div>';
		 }
		?>
		

    </body>
</html>