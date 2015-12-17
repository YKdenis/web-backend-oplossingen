<?php
session_start();
function __autoload( $classname )
{
    require_once( $classname . '.php' );
}

$message = Message::getMessage();

$email = '';
$kopie = false;
$text = '';
if( isset($_SESSION["email"]) )
{
    $email = $_SESSION["email"];
}
if( isset($_SESSION["text"]) )
{
    $text = $_SESSION["text"];
}
if( isset($_SESSION["kopie"]) )
{
    $kopie = $_SESSION["kopie"];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <title>Document</title>
    
    
</head>

<body>
  
   <h1>Contacteer ons</h1>
   
    <?php if ( $message ): ?>
    <div class="modal <?= $message[ 'type' ] ?>">
    <p><?php echo $message['text']?></p>
    <?php endif ?>
    
    <form action="contact.php" method="post">
        <ul>
            <li>
                <label for="email">E-mailadres</label>
                <input type="text" id="email" name="email" value="<?php echo $email ?>">
            </li>
            <li>
                <label for="message">Boodschap</label>
                <textarea name="message" id="message" cols="30" rows="10"><?php echo $text ?></textarea>
            </li>
            <li>
                <input type="checkbox" name="copy" id="copy" <?php if($kopie):?> checked <?php endif ?> >
                <label for="copy">Stuur een kopie naar mezelf</label>
            </li>
        </ul>
        <input type="submit" name="submit">
    </form>
</body>

</html>