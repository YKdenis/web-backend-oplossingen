<?php
session_start();
function __autoload( $classname )
{
    require_once( $classname . '.php' );
}

if( isset($_POST["generatePassword"]) )
{
    $_SESSION["registratie"]["email"] = $_POST["email"];
    $_SESSION["registratie"]["password"] = randomPassword( 5, 1 );
    header("Location: registratie-form.php");
    $message = new Message("notifaction", "Your password has been generated.");
}

if( isset($_POST["registreer"]) )
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $_SESSION["registratie"]["email"] = $_POST["email"];
    $_SESSION["registratie"]["password"] = $_POST["password"];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $invalidEmail = new Message("error", "Invalid email format.");
        header("Location: registratie-form.php");
            
    }
    else if($password = '')
    {
        $emptyPassword = new Message("error", "Please fill in your password.");
        header("Location: registratie-form.php");
                                     
    }
    else
		{
			// controleren of het emailadres reeds in de db voorkomt

			$connection	=	new PDO( 'mysql:host=localhost;dbname=opdracht_security_login', 'root', 'cohiba' );

			$db = new Database( $connection );

        
            // je geeft de query mee en de parameters die moeten worden ingevuld voor de query
			$userData	=	$db->query( 'SELECT * 
										FROM users 
										WHERE email = :email', 
									array(':email' => $email ) );

            // als het email namelijk waarde 0 geset is
			if ( isset( $userData['data'][ 0 ] ) )
			{
				$userExistsError = new Message( "error", "The user with this email " . $email . "already exist in our database" ); 

				header("Location: registratie-form.php" );
			}
			else
			{
				$newUser	=	User::CreateNewUser( $connection, $email, $password );

				if ( $newUser )
				{
					$registrationSuccess = new Message("success", "Welkom, you are now registered in our app.");
					header("Location: dashboard.php");
				}
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