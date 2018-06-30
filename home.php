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
		 if ($role == 'user') {
			 echo "<div id='form-container'><form action='ask.php' id='question-form' method='POST' onsubmit='return askQuestion(this);'>
			  <input type='text' name='question' id='question-value' required='required' placeholder='Ask anything about world cup' /> <br/>
			  <input type='hidden' id='answer' name='answer' />
			  <input type='submit' value='Ask'/>
		  </form></div>";
			while($row = $getQuestions->fetch(PDO::FETCH_ASSOC)) 
			{
				
				echo '<div>';
				echo '<div class="speech-bubble-left">';
				echo '<h4>'.$row['question'].'</h4>';
				echo '</div>';
				if ($row['botAnswer']) {
					echo '<div class="speech-bubble-right">';
					echo '<h4>'.$row['botAnswer'].'</h4>';
					echo '</div>';
				} 
				if ($row['operatorAnswer']) {
					echo '<div class="speech-bubble-right">';
					echo '<h4>'.$row['operatorAnswer'].'</h4>';
					echo '</div>';
				} else {
					if (!$row['requestedAnswer']) {
						$question = $row['question'];
						echo "<form action='request.php' id='request-form' method='POST'>
							<input type='submit' value='Request operator answer'/>
							<input type='hidden' id='question' name='question' value='$question'/>
							</form>";
					}
				}
				echo '</div>';
			}
		 } elseif  ($role == 'operator'){
			echo "<form action='answer.php' id='answer-form' method='POST'>";
			echo '<select name="selectedQuestion">';
			while($row = $getUnansweredQuestions->fetch(PDO::FETCH_ASSOC)) 
			{
				$question = $row['question'];
				echo "<option value='$question' name='$question'> $question </option>";
			}
			echo '</select>';
			echo  "<input type='text' name='answer' id='answer-value' required='required' placeholder='Your answer goes here'/>";
			echo  "<input type='submit' value='Answer the question'/>";
			echo "</form>";
		 }
		?>
		

    </body>
</html>