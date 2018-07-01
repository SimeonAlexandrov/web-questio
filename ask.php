<?php
    require_once 'config.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        session_start(); 
        if($_SESSION['user']){ 
            $question = $_POST['question'];
            $answer = ''.$_POST['answer'];
            $time= date('Y-m-d H:i:s');
            $host = $config['DB_HOST'];
            $dbname = $config['DB_NAME'];
	        $conn  = new PDO("mysql:host=$host;dbname=$dbname", $config['DB_USER'], $config['DB_PASS']);
            $stmt = $conn->prepare("INSERT INTO questions (question, asker, botAnswer, timeAdded) VALUES (:question, :asker, :botAnswer, :timeAdded)"); 
            $stmt->execute(['question' => $question, 'asker' => $_SESSION['user'], 'botAnswer' => $answer, 'timeAdded' => $time]);
            Print '<script>window.location.assign("home.php");</script>'; 
        }
        else {
            header("location:index.php"); 
        }
    }    
?>