<?php
    require_once 'config.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        session_start(); 
        if($_SESSION['user']){ 
            $question = $_POST['selectedQuestion'];
            $answer = ''.$_POST['answer'];
            $time= date('Y-m-d H:i:s');
            $host = $config['DB_HOST'];
            $dbname = $config['DB_NAME'];
            try {
                $conn  = new PDO("mysql:host=$host;dbname=$dbname", $config['DB_USER'], $config['DB_PASS']);
                $stmt = $conn->prepare("UPDATE questions SET operator = :user, operatorAnswer = :answer, timeAnswered = :timeAnswered  WHERE question=:question"); 
                $stmt->execute(['answer' => $answer, 'user' => $_SESSION['user'], 'timeAnswered' => $time, 'question' => $question]);
                Print '<script>window.location.assign("home.php");</script>'; 
            } 
            catch(PDOException $e) {
                echo $e;
            } 
        }
        else {
            header("location:index.php"); 
        }
    }    
?>