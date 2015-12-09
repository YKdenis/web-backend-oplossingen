<?php
    session_start();
    
    if(isset( $_POST['submit'] )) 
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
        }
         
    try 
    {
        
        $db = new pdo('mysql:host=localhost;dbname=opdracht_security_login', 'root',
        'cohiba'); 
        $messageContainer	=	'Verbonden met database.';

        $queryUser = "select * from users where email = :email";
        $statementUser = $db->prepare($queryUser);
        $statementUser->bindValue(':email', $email);
        $statementUser->execute();

        $results = $statementUser->fetch( PDO:: FETCH_ASSOC);
        echo $statementUser->fetch( PDO:: FETCH_ASSOC);
        if(empty($results))
        {
            $_SESSION['notificatie']['error']['notfound'] = 'The email you have entered does not exist.';

            header( 'Location:login-form.php' );
        }
        else
        {
            $salt = $results['salt'];
            $password_salted = $results['hashed_password'];
            $password_resalted = hash('sha512', $salt . $password);

            if($password_salted == $password_resalted)
            {
                header( 'Location:dashboard.php' );
            }
            else 
            {
                echo $password_salted;
                echo '<br />';
                echo $salt;
                echo '<br />';
                echo $password_resalted;
            }
        }
            
        
    }
    catch ( \PDOException $e )
    {
        $messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
        echo $messageContainer;
    }
?>