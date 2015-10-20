<?php

    session_start();

    if( isset( $_POST['submit'] )) {
    
        $_SESSION['nickname'] = $_POST['nickname'];

        $_SESSION['email'] = $_POST['email'];

    }
    else {
        
        $_SESSION['nickname'] = 'Unkown';
        $_SESSION['email'] = 'Unkown';
    }

    $straat = isset($_SESSION['straat']) ? $_SESSION['straat'] : '';

    $nummer = isset($_SESSION['nummer']) ? $_SESSION['nummer'] : '';

    $gemeente = isset($_SESSION['gemeente']) ? $_SESSION['gemeente'] : '';

    $postcode = isset($_SESSION['postcode']) ? $_SESSION['postcode'] : '';

    $straatfocus = isset($_GET['autofocus']) && $_GET['autofocus'] == "straat"  ? 'autofocus' : '';

    $nummerfocus = isset($_GET['autofocus']) && $_GET['autofocus'] == "nummer"  ? 'autofocus' : '';

    $gemeentefocus = isset($_GET['autofocus']) && $_GET['autofocus'] == "gemeente"  ? 'autofocus' : '';

    $postcodefocus = isset($_GET['autofocus']) && $_GET['autofocus'] == "postcode"  ? 'autofocus' : '';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <h1>Registratiegegevens</h1>

        <ul>
            <li>e-mail: <?php echo $_SESSION['email'] ?></li>
            <li>nickname: <?php echo $_SESSION['nickname'] ?></li>
            <li><a href="Registratiepagina.php?session=destroy">Destroy session</a></li>
        </ul>

        <h1>Deel 2: adres</h1>
        <form method="post" action="Overzichtspagina.php">
            <ul>
                <li>
                    <label for="straat">straat</label>
                    <input type="text" id="straat" name="straat" value = "<?php echo $straat ?>" <?php echo $straatfocus ?> >
                </li>
                <li>
                    <label for="nummer">nummer</label>
                    <input type="number" id="nummer" name="nummer" value = "<?php echo $nummer ?>" <?php echo $nummerfocus ?>>
                </li>
                <li>
                    <label for="gemeente">gemeente</label>
                    <input type="text" id="gemeente" name="gemeente" value = "<?php echo $gemeente ?>" <?php echo $gemeentefocus ?>>
                </li>
                <li>
                    <label for="postcode">postcode</label>
                    <input type="text" id="postcode" name="postcode" value = "<?php echo $postcode ?>" <?php echo $postcodefocus ?>>
                </li>
            </ul>
            <input type="submit" value="Volgende" name="submit">
        </form>

    </body>
</html>