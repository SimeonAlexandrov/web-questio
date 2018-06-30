<?php
    require_once 'config.php'; 
    if($_SESSION['user']){ 
    }
    else{
        header("location:index.php"); 
    }
    $user = $_SESSION['user']; 
    $role = $_SESSION['role'];

    // Load previous questions
    $host = $config['DB_HOST'];
    $dbname = $config['DB_NAME'];

    $conn  = new PDO("mysql:host=$host;dbname=$dbname", $config['DB_USER'], $config['DB_PASS']);
    $getQuestions = $conn->prepare("SELECT * FROM questions WHERE asker = :user ORDER BY timeAdded DESC");
    $getQuestions->execute(['user' => $user]);

    $getUnansweredQuestions = $conn->prepare("SELECT * FROM questions WHERE (requestedAnswer = TRUE AND operator IS NULL )  ORDER BY timeAdded DESC");
    $getUnansweredQuestions->execute();

    $getPreviouslyAnsweredQuestions = $conn->prepare("SELECT * FROM questions WHERE operator = :user ORDER BY timeAnswered DESC");
    $getPreviouslyAnsweredQuestions->execute(['user' => $user]);
?>