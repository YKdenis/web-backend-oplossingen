<?php
session_start();

function __autoload( $classname )
{
    require_once( $classname . '.php' );
}


if( isset($_POST["submit"]) )
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $_SESSION["login"]["email"] = $_POST["email"];
    $_SESSION["login"]["password"] = $_POST["password"];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $invalidEmail = new Message("error", "Invalid email format.");
        header("Location: login-form.php");
            
    }
    else if($password == '')
    {
        $emptyPassword = new Message("error", "Please fill in your password.");
        header("Location: login-form.php");
                                     
    }
    else
    {
        $connection 	=	 new PDO( 'mysql:host=localhost;dbname=opdracht_security_login', 'root', 'cohiba' );

        //$db = new Database( $connection );
        
        $query = 'SELECT * FROM users WHERE email = :email';
 
        $preparedStatement = $connection->prepare($query);
        $preparedStatement->bindValue(':email', $email, \PDO::PARAM_STR);
        $result = $preparedStatement->execute();
        $array = $preparedStatement->fetch(\PDO::FETCH_ASSOC);
        // echo 'array ' .$email;
        // echo $result;
        // var_dump($array);
        // return;
        if ($array) {
            // Controle of het paswoord correct is of niet
            $salt = $array['salt'];
            $passwordDb = $array['hashed_password'];


				$newlyHashedPassword = hash( 'sha512', $salt . $password);

				var_dump( $newlyHashedPassword );

				if ($newlyHashedPassword == $passwordDb)
				{
					$loginUser	=	User::createCookie( $salt, $email );

					if ( $loginUser )
					{
						$registrationSuccess = new Message("success", "Welcome, your logged in.");
						header('location: dashboard.php');
					}
				}
				else
				{
					$userExistsMessage	=	new Message('error', 'Log in failed, try again.');
					header('location: login-form.php');
				}
			}
			else
			{
				$userExistsMessage	=	new Message('error', 'This user does not exist in the database.');
				header('location: login-form.php' );
            }
    }
}
?>