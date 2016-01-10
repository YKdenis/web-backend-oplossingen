<?php

$action = 'none';
if (isset($_POST['action'])) // postback de gebruiker heeft op een button element geklikt
{

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
    $artikelModel = new artikel_model($provider->getPdo(), $feedback);
    $rows = null;

    $action = $_POST['action'];

    switch ($action) {
        case 'content' :
            if (isset($_POST['content'])) {
                $artikelModel->setSearch($_POST['content']);
                $rows = $artikelModel->searchContent();
            }
            break;
        case 'datum' :
            if (isset($_POST['date'])) {
                $artikelModel->setSearch($_POST['date']);
                $rows = $artikelModel->searchDatum();
            }
            break;
        default :
            break;
    }

    // var_dump($contactModel);
// sluiten van de connectie
    $provider->close();
    $feedback->log();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<?php isset($_POST['action']) ? $feedback->getText() : ''; ?>

<form method="post" action="artikel-overzicht.php">
    <label for="content">Zoeken in artikels:</label>
    <input type="text" name="content" id="content">
    <button name="action" value="content">Zoeken</button>
</form>

<form method="post" action="artikel-overzicht.php">
    <label for="date">Zoeken op datum:</label>
    <select name="date" id="date">

        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>

    </select>
    <button name="action" value="datum">Zoeken</button>
</form>

<h1>Artikels overzicht</h1>

<?php
if (isset($_POST['action'])) {

    if (isset($rows) && count($rows) > 0) {
        foreach ($rows as $row) { ?>
            <article>
                <h1><?php echo $row['titel']; ?></h1>
                <p><?php echo $row['artikel']; ?></p>
                <p><?php echo $row['datum']; ?></p>
            </article>
        <?php }
    } else {
        ?>
        <p>Geen artikels gevonden met zoekopdracht <?php echo $artikelModel->getSearch(); ?>.</p>
    <?php }
} ?>

<a href="artikel-toevoegen.php">Artikel toevoegen</a>

<div class="feedback">
    <?php isset($_POST['action']) ? $feedbackView->output() : ''; ?>

</div>
</body>
</html>
