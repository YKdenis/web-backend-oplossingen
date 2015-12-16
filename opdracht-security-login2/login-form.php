<?php
session_start();
function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$connection = new PDO( 'mysql:host=localhost;dbname=opdracht_security_login', 'root', 'cohiba' );
	$password = '';
    $email = '';

    // als de user nog ingelogd is maw als de cookie nog bestaat wordt hij verwezen naar het dashboard
	if ( User::validate( $connection ) )
	{
		header('location: dashboard.php');
	}
	else
	{
        // de message wordt opgehaald van de logout.php page of de login-process page
		$message = Message::getMessage();

        // indien men al eens heeft proberen inloggen zal de data worden onthouden
		if ( isset( $_SESSION['login'] ) )
		{
			$email = $_SESSION['login']['email'];
			$password =	$_SESSION['login']['password'];
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Inloggen</h1>
        
        <!-- als er een message is geset dan pas wordt hij getoont -->
		<?php if ( $message ): ?>
			<div class="modal <?php echo $message['type'] ?>">
				<?php echo $message['text'] ?>
			</div>
		<?php endif ?>

		<form method="post" action="login-process.php" >
			<ul>
				<li>
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="<?= $email ?>">
				</li>
				
				<li>
					<label for="password">Paswoord</label>
					<input type="password" name="password" id="password" value="<?= $password ?>">
				</li>
			</ul>
			
			<input type="submit" name="submit" value="log in">
		</form>
		
		<p>Nog geen login? <a href="registratie-form.php">Registreer dan hier.</a></p>
		
</body>
</html>