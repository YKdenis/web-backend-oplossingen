<?php
$action = 'none';
if (isset($_POST['action'])) // postback de gebruiker heeft op een button element geklikt
{
    $action = $_POST['action'];
    switch ($action) {
        case 'artikel_insert' :
// connectie met de database maken
// om een reactie van de gebruiker in de tabel te inserten
            require('../amen/mysql/src/Connection.php');
            require('../amen/dialog/autoload.php');
            require('Provider.php');
            require('artikel_model.php');
            $feedback = new \Amen\Dialog\Model\Feedback();
            $feedbackView = new \Amen\Dialog\View\Feedback($feedback);
            $provider = new OpdrachtArtikels\Provider($feedback);
            $provider->open();
            $contactModel = new artikel_model($provider->getPdo(), $feedback);

            if (empty($_POST['titel'])) {
                $feedback->setText('Please enter a title.');
                $feedback->setName('invalid titel');
                $feedback->setCode('VALIDATION');
                $action = 'none';
            } else {
                $title = filter_var($_POST['titel'], FILTER_SANITIZE_STRING);
                $contactModel->setTitel($title);
            }

            if (empty($_POST['artikel'])) {
                $feedback->setText('The article may not be empty.');
                $feedback->setName('invalid article');
                $feedback->setCode('VALIDATION');
                $action = 'none';
            } else {
                $artikel = filter_var($_POST['artikel'], FILTER_SANITIZE_STRING);
                $contactModel->setArtikel($artikel);
            }

            if (empty($_POST['kernwoorden'])) {
                $feedback->setText('Please fill in some keywords.');
                $feedback->setName('invalid keywords');
                $feedback->setCode('VALIDATION');
                $action = 'none';
            } else {
                $kernwoorden = filter_var($_POST['kernwoorden'], FILTER_SANITIZE_STRING);
                $contactModel->setKernwoorden($kernwoorden);
            }
// Alleen als bovenstaande if's zijn doorlopen zal $action nog op
// 'contact' staan. Dan pas zal de methode create worden uitgevoerd.
            if ($action == 'artikel_insert') {
                //echo 'i am here';
                $contactModel->create();
            }

// var_dump($contactModel);
// sluiten van de connectie
            $provider->close();
            $feedback->log();
            break;
        default :
            break;
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
<h1>Artikel toevoegen</h1>

<a href="artikel-overzicht.php">Terug naar overzicht</a>

<form action="artikel-toevoegen.php" method="post">
    <div style="color: green">
        <?php isset($_POST['action']) ? $feedback->getText() : ''; ?>
    </div>
    <ul>
        <li>
            <label for="titel">Titel</label>
            <input type="text" id="titel" name="titel" value="<?php echo isset($_POST['titel']) ? $_POST['titel'] : ''; ?>">
        </li>
        <li>
            <label for="artikel">Artikel</label>
            <textarea id="artikel" name="artikel"><?php echo isset($_POST['artikel']) ? $_POST['artikel'] : ''; ?></textarea>
        </li>
        <li>
            <label for="kernwoorden">Kernwoorden</label>
            <input type="text" id="kernwoorden" name="kernwoorden" value="<?php echo isset($_POST['kernwoorden']) ? $_POST['kernwoorden'] : ''; ?>">
        </li>
        <li>
            <label for="datum">Datum</label>
            <input type="date" id="datum" name="datum">
        </li>
    </ul>
    <!-- de value is de waarde dat meegegeven wordt met de $_POST['action'] indien er
    er op de button wordt geklikt -->
    <button name="action" value="artikel_insert">Verstuur</button>
    <div class="feedback">
        <?php isset($_POST['action']) ? $feedbackView->output() : ''; ?>

    </div
</form>

</body>

</html>
