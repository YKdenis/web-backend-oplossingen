<?php

session_start();
function __autoload( $classname )
{
    require_once( $classname . '.php' );
}

$admin = 'eazepop@gmail.com';
$email = '';
$text = '';
$kopie = $_POST["copy"];
$titel = 'Kopie bericht';
$headers = 'From: '. $admin;


if( isset($_POST["submit"]))
{
    if(!"" == trim($_POST["email"]))
    {
        $email = $_POST["email"];
    }
    else 
    {
        $emptyEmail = new Message('error', 'You have not entered an email.');
        header( 'Location: contact_form.php');
    }
    
    if(!"" == trim($_POST["message"]) )
    {
        $text = $_POST["message"];
    }
    else 
    {
        $emptyMessage = new Message('error', 'You have not entered a message.');
        header( 'Location: contact_form.php');
    }
    
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["text"] = $_POST["message"];
    $_SESSION["kopie"] = $_POST["copy"];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
            $invalidEmail = new Message ('error', 'The email you have entered is invalid.');
            header( 'Location: contact_form.php' );
    }
    else
    {
        try 
        {
            $db = new pdo('mysql:host=localhost;dbname=mail_service', 'root', 'cohiba'); 

            $insertQuery = 'insert into users (email, message, time_sent) values (:email, :message, NOW())';

            $preparedStatement = $db->prepare($insertQuery);

            $preparedStatement->bindParam(':email', $email, \PDO::PARAM_STR);
            $preparedStatement->bindParam(':message', $text, \PDO::PARAM_STR);
            $preparedStatement->execute();
            
            if($kopie)
            {
                if( mail( $email, $titel, $text, $headers ) && mail( $admin, $titel, $text, $headers ) )
                {
                    $succesMessage = new Message('succes', 'A copy has been send to your email.');
                    header( 'Location: contact_form.php' );
                }
                else
                {
                    $failMessage = new Message('error', 'A problem occured, we could not send you a copy. Try again.');
                    header( 'Location: contact_form.php' );
                }
            }
            else
            {
                header( 'Location: contact_form.php' );
            }
        }
        catch( \PDOException $e )
        {
                $messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
                echo $messageContainer;
        }
    }
}
?>