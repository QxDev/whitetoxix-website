<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=Netzwerk', 'root', '***');
 
if(isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();
        
    //ÃœberprÃ¼fung des Passworts
    if ($user != false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zum <a href="musiclibrary.php">internen Bereich</a>');
    } else {
        $errorMessage = "Username oder Passwort ung&uuml;ltig<br>";
    }
    
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="login.css" type="text/css">
		<link rel="icon" href="img/favicon.ico" type="image/x-icon">
		<link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
		<title>Login - WhiteToxix Networks</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	 
	<?php 
	if(isset($errorMessage)) {
		echo $errorMessage;
	}
	?>

	<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<h1>WhiteToxix Networks</h1>
			<h2>dein Netzwerk</h2>
		</div>
		<br>
		<form action="?login=1" method="post">
			<div class="login">
				<input type="text" placeholder="Username" maxlength="250" name="username"><br>
				<input type="password" placeholder="Password" maxlength="250" name="password"><br>
				<input type="submit" value="login">
			</div>
		</form> 
	</body>
</html>
