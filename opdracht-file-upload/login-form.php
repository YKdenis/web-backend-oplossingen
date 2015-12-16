<?php
    session_start();
    setcookie('login', "", time()-3600);
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>

    <body>
        <h1>Inloggen</h1>
        <?php if( isset( $_GET['uitgelogd'] ) ): if( $_GET['uitgelogd'] == true ): ?>
        <p>U bent uitgelogd.</p>
        <?php endif; endif; ?>
        <?php  if(isset($_SESSION['notificatie']['error']['notfound'])): ?>
        <p><?php echo $_SESSION['notificatie']['error']['notfound'] ?></p>
        <?php unset($_SESSION['notificatie']['error']['notfound']) ?>
        <?php endif ?>
        <form method='post' action='login-process.php'>
            <ul>
                <li>
                    <label for="email">e-mail</label>
                    <input type="text" id="email" name="email">
                </li>
                <li>
                    <label for="password">paswoord</label>
                    <input type="password" id="password" name="password">
                </li>
            </ul>
            <input type="submit" value="Inloggen" name="submit">
        </form>
        <p>Nog geen account? Maak er dan eentje aan op de <a href="registratie-form.php">registratiepagina</a>.</p>

    </body>

    </html>
