<?php

    $password = 'qwerty';
    $name = 'Denis';
    $message = ' ';

    if( isset( $_POST['submit'] ) ) {
        
        if( $_POST['name'] == $name && $_POST['password'] == $password ) {
            
            $message = 'Welkom ' . $_POST['name'] . '.';
            
        }
        else {
            
            $message = 'You have entered a wrong name/password.';
            
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="opdracht-post.php" method="post"
       id="idform">
        
        <p> <?php echo $message ?> </p>
        
        <h2>Log in</h2>
        <p>
        <label for="idname">Name:</label>
        <input type="text" id="idname" name="name">
        </p>
        
        <p>
        <label for="idpassword">Password:</label>
        <input type="password" id="idpassword" name="password">
        </p>
        
        <input type="submit" name="submit" value="submit">
    </form>
    
</body>
</html>