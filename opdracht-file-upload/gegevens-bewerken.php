<?php 
session_start();
function __autoload( $classname )
{
    require_once( $classname . '.php' );
}

$gegevens = explode(',', $_COOKIE['login']);
$currentEmail = $gegevens[0];

$newEmail = $_POST['email'];

try
{
    
if (isset($_POST['submit'])) 
{
    if(!filter_var($newEmail, FILTER_VALIDATE_EMAIL))
    {
        $invaledEmail = new Message('error', 'Invalid email.');
        header('Location: gegevens-wijzigen-form.php');
    }

    
    $fileName = $_FILES["profile_picture"]["name"];
    

    if ((($_FILES["profile_picture"]["type"] == "image/gif")
    || ($_FILES["profile_picture"]["type"] == "image/jpeg")
    || ($_FILES["profile_picture"]["type"] == "image/png"))
    && ($_FILES["profile_picture"]["size"] < 2000000)) 
    {
        
    
    
		// Het bestand moet gif, jpeg of png zijn en mag niet groter zijn dan 2MB
		  
			if ($_FILES["profile_picture"]["error"] > 0) 
			{
				// Als er een fout in het bestand wordt gevonden (bv. corrupte file door onderbroken upload), moet er een foutboodschap getoond worden
				throw new Exception( "Return Code: " . $_FILES["profile_picture"]["error"] );
                
			} 
			else 
			{
				// De root van het bestand moet achterhaald worden om de absolute pathnaam (de plaats op de schijf van de server) te achterhalen
				// Zo weet de server waar het bestand moet terecht komen.
				// We kunnen dit doen door de functie dirname() toe te passen op dit bestand (=__FILE__)
				define('ROOT', dirname(__FILE__));
				
				if (!file_exists(ROOT . "/image/" . $fileName)) 
                {
					
					uploadFile($fileName); 
                   
				} 
				
				
                    $db = new pdo('mysql:host=localhost;dbname=opdracht_file_upload', 'root','cohiba'); 
                    $messageContainer	=	'Verbonden met database.';

                    $queryGetInfo = "select * from users where email = :email";
                    $statementGetInfo = $db->prepare($queryGetInfo);
                    $statementGetInfo->bindValue(':email', $currentEmail);
                    $statementGetInfo->execute();
                
                    $infoDb = $statementGetInfo->fetch( PDO:: FETCH_ASSOC);

                    $new_salted_email =  hash('sha512', $infoDb['salt'] . $newEmail);

                    $queryUpdate = "update users set email=:email, profile_picture=:profile_picture where id=:id";
                    $id = $infoDb['id'];
                    $profile_picture = 'image/' . $fileName;
                    $statementUpdate = $db->prepare($queryUpdate);
                    $statementUpdate->bindValue(':email', $newEmail);
                    $statementUpdate->bindValue(':id', $id);
                    $statementUpdate->bindValue(':profile_picture', $profile_picture);
                    echo $id;
                    echo $currentEmail;
                    if($statementUpdate->execute())
                    {

                        setcookie('login', '', time() - 2592000);
                        setcookie('login', $newEmail . ',' . $new_salted_email . ',' . $profile_picture, time() + 2592000);

                    }
                }
                
		} 
		else 
		{
			throw new Exception( 'Ongeldig bestand' );
		}
}
}
catch( Exception $e )
{
    $uploadFailed = new Message('error', $e->getMessage());
}

header('Location: gegevens-wijzigen-form.php' );

function uploadFile($fileName) {
    
    
    move_uploaded_file($_FILES["profile_picture"]["tmp_name"], (ROOT . "/image/" . $fileName));

    $fileInfo = array('upload', 'fileType', 'size', 'tmp_filename', 'opgeslagen_in');
    $fileInfo[ 'upload' ]	=	$fileName;
    $fileInfo[ 'type' ]		=	$_FILES["profile_picture"]["type"];
    $fileInfo[ 'size' ]		=	( $_FILES["profile_picture"]["size"] / 1024 ) . 'kb';
    $fileInfo[ 'tmp_filename' ]	=	 $_FILES["profile_picture"]["tmp_name"];
    $fileInfo[ 'opgeslagen_in' ]	=	ROOT . "/image/" . $fileName;
    
    $uploadSucces = new Message('success', 'Your picture has successfully been uploaded.');
    
}


            
?>
		
	