<?php
    session_start();
    function __autoload( $classname )
    {
        require_once( $classname . '.php' );
    }
    

    $gegevens = explode(',', $_COOKIE['login']);
    
    $email = $gegevens[0];

    $salted_email = $gegevens[1];
    $prof_pic = $gegevens[2];

    $message = Message::getMessage();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
    img {
        width: 75px;
    }
    </style>
</head>

<body>
    <p><a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <?php echo $email?> | <a href="login-form.php?uitgelogd=true">uitloggen</a></p>

    <h1>Gegevens wijzigen</h1>

    <form method="post" action="gegevens-bewerken.php" enctype="multipart/form-data">
       <?php var_dump($message) ?>
        <?php if ( $message ): ?>
			<div class="modal <?= $message[ 'type' ] ?>">
			<p><?php echo $message['text']?></p>
			
			</div>
		<?php endif ?>

        <ul>

            <li>
                <label for="profile_picture">Profielfoto
                    <img class="profile-picture" src="<?php echo $prof_pic ?>" alt="<?php echo $email ?>">
                </label>
                <input type="file" id="profile_picture" name="profile_picture">
            </li>

            <li>
                <label for="email">e-mail</label>
                <input type="text" id="email" name="email" value="<?php echo $email ?>">
            </li>

        </ul>

        <input type="submit" value="Gegevens wijzigen" name="submit">
    </form>

</body>

</html>
