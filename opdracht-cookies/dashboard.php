<?php

         

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Dashboard</h1>
                    
    <p><?php echo $_COOKIE['testCookie'] ?> U bent ingelogd.</p>
    <p><a href="inloggen.php?removecookie=true">Uitloggen</a></p>

</body>
</html>