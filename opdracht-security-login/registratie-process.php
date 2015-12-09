<?php
    session_start();

    unset($_SESSION['notificatie']['error']['message']);

    if( isset($_POST['generatePassword']) )
    {
        $randomPassword = randomPassword( 10, 2 );
        $_SESSION['registratie']['password'] = $randomPassword;
        $_SESSION['registratie']['email'] = $_POST['email'];
        header( 'Location:registratie-form.php' );
    }

    if( isset($_POST['Registreer']))
    {
        unset($_SESSION['registratie']['email']);
        $_SESSION['registratie']['email'] = $_POST['email'];
        $email = $_SESSION['registratie']['email'];
        $password = $_SESSION['registratie']['password'];
        
        if(empty($email))
        {
            $_SESSION['notificatie']['error']['message'] =  'Email required.';
            header( 'Location:registratie-form.php' );
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['notificatie']['error']['message'] = 'The email you have entered is invalid!';
            header( 'Location:registratie-form.php' );
        }
        else
        {
            
             try {
                $db = new pdo('mysql:host=localhost;dbname=opdracht_security_login', 'root',
                'cohiba'); 
                $messageContainer	=	'Verbonden met database.';
                
                $queryValidEmail = "select * from users where email = :email";
                $statementValidEmail = $db->prepare($queryValidEmail);
                $statementValidEmail->bindValue(':email', $email);
                $statementValidEmail->execute();
                
                 
                if(!empty($statementValidEmail->fetch( PDO:: FETCH_ASSOC)))
                {
                    $_SESSION['notificatie']['error']['message'] = 'The email you have entered is already registered';
                    header( 'Location:registratie-form.php' );
                }
                else
                {
                    $salt = substr(sha1(mt_rand()),0,22);
                    $hashed_password = hash( 'sha512', $salt . $password );
                    $hashed_email = hash( 'sha512', $salt . $email );
                    
                    
                    $queryInsert = "insert into users (email, salt, hashed_password, last_login_time) values(:email, :salt, :hashed_password, NOW())";
                    $statementInsert = $db->prepare($queryInsert);
                    $statementInsert->bindValue(':email', $email);
                    $statementInsert->bindValue(':salt', $salt);
                    $statementInsert->bindValue(':hashed_password', $hashed_password);
                    $statementInsert->execute();
                    
                    
                    
                    if( setcookie('login', $email . ',' . $hashed_email, time() + 2592000))
                    {
                        header( 'Location:dashboard.php' );
                    }
                    else
                    {
                        header( 'Location:registratie-form.php' );
                    }
                    
                    // Blowfish $2a$10$ --> $2 indicates the blowfish algoritm is being used. $10 is the "cost parameter". This is the                       // base-2 logarithm of how many iterations it will run (10 => 2^10 = 1024 iterations.) 
                    
                }
            }
            catch ( \PDOException $e ){
                $messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
                echo $messageContainer;
            }
            
        }
    }

    function randomPassword( $passwordLength, $security ) {
    
        if($security == 1 ) 
        {
            $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890';
        }
        else if( $security == 2 )
        {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        }
        else
        {
            $alphabet = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
        }
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $passwordLength; $i++) {
        $n = rand(0, $alphaLength); // generates random integer between 0 and arrayLength
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

?>

