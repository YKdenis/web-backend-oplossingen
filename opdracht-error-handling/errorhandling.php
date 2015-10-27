<?php
session_start();

$isValid = false;
try {
    if( isset ($_POST['submit']) ) {
        
        
        if( isset ($_POST['code']) ) {
            
            if( strlen($_POST['code']) == 8)
            {
                $isValid = true;
            }
            else {
                throw new exception ('VALIDATION-CODE-LENGTH');
            }
            
        }
        
    }
    else {
        
        throw new exception ('SUBMIT-ERROR');
        
    }
}
catch( Exception $e ) {
    
    $messageCode = $e->getMessage();
    $message = array();
    $createMessage = false;
    
    switch ($messageCode) {
            
        case 'SUBMIT-ERROR':
            $message['type'] = 'error';
            $message['text'] = 'Er werd met het formulier geknoeid';
            break;
            
        case 'VALIDATION-CODE-LENGTH':
            $message['type'] = 'error';
            $message['text'] = 'De kortingscode heeft niet de juiste lengte';
            $createMessage = true;
            break;
    }
    
    logToFile( $message );
    
    if( $createMessage == true) {
        
        createMessage( $message );
        
    }
}

$message = showMessage();

function logToFile ( $arrayMessage ) {
    
    $date ='[' . date("Y-m-d h:i:sa") . ']';
    $ip = $_SERVER['REMOTE_ADDR'];
    $errorType = $arrayMessage['type'];
    $errorText = $arrayMessage['text'];
    file_put_contents('log.txt', "$date $ip $errorType $errorText" . PHP_EOL , FILE_APPEND);
}

function createMessage( $arrayMessage ) {
    
    $_SESSION['message']['type'] = $arrayMessage['type'];
    $_SESSION['message']['text'] = $arrayMessage['text'];
}

function showMessage () {
    
    if( isset( $_SESSION['message'] ) ) {
        
        $showMessage = $_SESSION['message']['text'];
        unset ( $_SESSION['message'] );
        
    }
    else {
        
        $showMessage = false;
        
    }
    
    return $showMessage;
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Geef uw kortingscode op</h1>

    <p><?php echo $message; ?></p>
   <?php if($isValid == false) { ?>
    <form method="POST" action="#">
        <ul>
            <li>
                <label for="code">Kortingscode</label>
                <input type="text" id="code" name="code">
            </li>
        </ul>

        <input name="submit" type="submit">
    </form>
    <?php } else {?>
    <p>Korting toegekend!</p>
    <?php } ?>

</body>
</html>