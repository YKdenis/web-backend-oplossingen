<?php
// Simple basic unit test Provider
require ('../../amen/mysql/src/Connection.php');
require ('../../amen/dialog/autoload.php');
require('Provider.php');
require('contact_model.php');
$feedback = new \Amen\Dialog\Model\Feedback();
$feedbackView = new \Amen\Dialog\View\Feedback($feedback);
$provider = new OpdrachtAjax\Provider($feedback);
$provider->open();
// $feedback en $provider zijn objecten dus worden by reference
// doorgegeven. Alle wijzigingen die de contact klasse maakt aan
// $provider en $feedback worden dus ook gemaakt in deze
// $provider en $feedback
$contactModel = new ContactModel($provider->getPdo(), $feedback);
$contactModel->setEmail('Gilles@hooland.com');
$contactModel->setMessage('Gilles heeft geen brave hond.');
$contactModel->create();
$provider->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Webwinkel</title>
</head>
<body>
<div class="feedback">
    <?php $feedbackView->output();?>
</div>
</body>
</html>
