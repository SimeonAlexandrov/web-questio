<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back<br/><a/>
        <form action="register.php" method="POST">
           Enter Username: <input type="text" name="username" required="required" /> <br/>
           Enter password: <input type="password" name="password" required="required" /> <br/>
           Enter role: <input type="radio" name="role" value="user"> User <input type="radio" name="role" value="operator"> Operator<br>
           <input type="submit" value="Register"/>
        </form>
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