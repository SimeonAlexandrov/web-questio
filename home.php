<html>
	<head>
		<title>World Cup Q&A</title>

		<link rel="stylesheet" type="text/css" media="screen" href="./styles/global.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800" rel="stylesheet" type="text/css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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
		<div class="container">
		<h1>World Cup Q&A</h1>
		<div id='history-container' class='bubble'>
		<p>Hello <?php Print "$user";?>!</p> 
		<p> 
			<?php 
			if($role == 'user') {
				Print "You logged in with "."$role"." role. Feel free to ask any question about the world cup and request operator assistance.";
			} elseif ($role == 'operator') {
				Print "You logged in with "."$role"." role. Feel free to answer some of the questions.";
			}
			?>
		</p> 
		<a href="logout.php">Click here to logout</a><br/><br/>
		</div>

		<?php
		require_once 'getQuestions.php'; 
		require_once 'helpers.php';
		 if ($role == 'user') {
			echo "<div id='form-container' class='bubble'>";
			getAskForm();
			echo'</div>';		
			getHistory($getQuestions, $role);;

		 } elseif  ($role == 'operator'){
			echo "<div id='form-container' class='bubble'>";
			getAnswerForm($getUnansweredQuestions);
			echo'</div>';
			getHistory($getPreviouslyAnsweredQuestions, $role);
		 }
		?>
		
		</div>
    </body>
</html>