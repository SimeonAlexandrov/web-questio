<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        session_start(); 
        if($_SESSION['user']){ 
            $question = $_POST['question'];
            echo $question;
            echo $_SESSION['user'];
            $conn  = new PDO('mysql:host=localhost;dbname=questio', 'root', '');
            $stmt = $conn->prepare("INSERT INTO questions (question, asker) VALUES (:question, :asker)"); 
            $stmt->execute(['question' => $question, 'asker' => $_SESSION['user']]);
            Print '<script>alert("Successfully added question!");</script>';
            Print '<script>window.location.assign("home.php");</script>'; 
        }
        else {
            header("location:index.php"); 
        }
    }    
?>