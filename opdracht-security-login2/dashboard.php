<?php
function __autoload( $classname )
{
    require_once( $classname . '.php' );
}

$connection 	=	 new PDO( 'mysql:host=localhost;dbname=opdracht_security_login', 'root', 'cohiba' );

if( !User::validate( $connection ) )
{
    User::logout();
    new Message("error", "Something went wrong, please try again.");
    header('location: login-form.php');
}
else
{   // haalt de succes message op die in de registratie-proces is aan gemaakt ($registrationSucces)
    $message = Message::getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
  
   <?php if ( isset ( $message ) ): ?>
			<div class="modal <?= $message['type'] ?>">
				<?= $message['text'] ?>
			</div>
		<?php endif ?>
   
    <a href="logout.php">Uitloggen</a>
</body>
</html>