<?php
session_start();
function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

// haalt de SESSION['message'] op die onlangs ingevuld is geweest en zal de SESSION ook weer verwijderen op het einde van de methode waardoor er nooit meer dan 1 message wordt opgeslagen
$message = Message::getMessage();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1>Registreren</h1>
    
    <?php if ( $message ): ?>
			<div class="modal <?php echo $message['type'] ?>">
				<?php echo $message['text'] ?>
			</div>
    <?php endif ?>
   
    <form method="post" action="registratie-process.php">
        <ul>
            <li>
                <label for="email">e-mail</label>
                <input type="text" id="email" name="email" value="<?php echo $_SESSION["registratie"]["email"] ?>">
            </li>
            <li>
                <label for="password">paswoord</label>
                <input type="password" id="password" name="password" value="<?php echo $_SESSION["registratie"]["password"] ?>">
                <input type="submit" name="generatePassword" value="Genereer een paswoord">
            </li>
        </ul>
        <input type="submit" value="Registreer" name="registreer">
    </form>

</body>

</html>