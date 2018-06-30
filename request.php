<?php
    require_once 'config.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        session_start(); 
        if($_SESSION['user']){ 
            $question = $_POST['question'];
            echo $question;
            echo $_SESSION['user'];
            $host = $config['DB_HOST'];
            $dbname = $config['DB_NAME'];
	        $conn  = new PDO("mysql:host=$host;dbname=$dbname", $config['DB_USER'], $config['DB_PASS']);
            $stmt = $conn->prepare("UPDATE questions SET requestedAnswer=TRUE WHERE  question=:question AND asker=:asker"); 
            $stmt->execute(['question' => $question, 'asker' => $_SESSION['user']]);
            Print '<script>window.location.assign("home.php");</script>'; 
        }
        else {
            header("location:index.php"); 
        }
    }    
?>