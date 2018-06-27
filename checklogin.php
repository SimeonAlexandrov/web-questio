<?php
	session_start();
	$username = $_POST['username'];
    $password = $_POST['password'];
	$conn  = new PDO('mysql:host=localhost;dbname=questio', 'root', '');
	$sql = "SELECT * from users" ; 
    
    $query = $conn->prepare($sql); 
    $query->execute();
    $table_users = "";
    $table_password = "";
	if($query->fetchColumn() > 0) 
	{
        $bool = false;
        while($row = $query->fetch()) {
            $table_users = $row['username']; 
            $table_password = $row['password']; 
            if( ($table_password == $password) && ($table_users == $username)) 
            {
                $bool = true;
                $_SESSION['user'] = $username; 
                header("location: home.php"); 
            }
        }  
        
        if(!$bool) {
            Print '<script>alert("Incorrect Password!");</script>'; 
			Print '<script>window.location.assign("login.php");</script>'; 
        }
	}
	else
	{
		Print '<script>alert("Incorrect Username!");</script>'; 
		Print '<script>window.location.assign("login.php");</script>'; 
	}
?>