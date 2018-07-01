<html>
    <head>
    <title>World Cup Q&A</title>
        <link rel="stylesheet" type="text/css" media="screen" href="./styles/global.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800" rel="stylesheet" type="text/css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h1>Registration</h1>
            <div class="bubble">
                <a href="index.php">Go back</a>
                <a href="login.php">Login</a>
                </br>
                </br>
                <form action="register.php" method="POST">
                <input type="text" name="username" required="required" placeholder="Enter username" /> <br/>
                <input type="password" name="password" required="required" placeholder="Enter password"/> <br/>
                <input type="radio" name="role" value="user" required="required"> User <input type="radio" name="role" value="operator"> Operator<br>
                <input type="submit" value="Register"/>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
require_once 'config.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $bool = true;

    $host = $config['DB_HOST'];
    $dbname = $config['DB_NAME'];

	$conn  = new PDO("mysql:host=$host;dbname=$dbname", $config['DB_USER'], $config['DB_PASS']);
	$sql = "SELECT * FROM users";
    $query = $conn->query($sql) or die("failed!");
	while($row = $query->fetch(PDO::FETCH_ASSOC)) 
	{
		$table_users = $row['username']; 
		if($username == $table_users) 
		{
			$bool = false; 
			Print '<script>alert("Username has been taken!");</script>'; 
			Print '<script>window.location.assign("register.php");</script>'; 
		}
	}
	if($bool) 
	{
		$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)"); 
        
        $stmt->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => $role]);
        Print '<script>alert("Successfully Registered!");</script>'; 
		Print '<script>window.location.assign("register.php");</script>'; 
	}
}
?>