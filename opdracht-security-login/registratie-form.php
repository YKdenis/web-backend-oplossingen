<?php
session_start();

$email = $_SESSION['registratie']['email'];
$password = $_SESSION['registratie']['password'];
          

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>

    <body>
        <h1>Registreren</h1>
        <form method="post" action="registratie-process.php">
            <ul>
                <li>
                    <label for="email">e-mail</label>
                    <input type="text" id="email" name="email" value="<?php echo $email ?>">

                    <?php if( isset($_SESSION['notificatie']['error']['message'] ) ): ?>
                        <span><?php echo $_SESSION['notificatie']['error']['message']?></span>
                    <?php endif ?>
                </li>
                <li>
                    <label for="password">paswoord</label>
                    <input type="text" id="password" name="password" value="<?php echo $password ?>">
                    <input type="submit" name="generatePassword" value="Genereer een paswoord">
                </li>
            </ul>
            <input type="submit" value="Registreer" name='Registreer'>
        </form>

    </body>

    </html>
