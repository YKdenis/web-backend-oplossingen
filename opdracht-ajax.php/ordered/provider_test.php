<?php
// Simple basic unit test Provider
require ('../../amen/mysql/src/Connection.php');
require ('../../amen/dialog/autoload.php');
require('Provider.php');
$feedback = new \Amen\Dialog\Model\Feedback();
$feedbackView = new \Amen\Dialog\View\Feedback($feedback);
$provider = new OpdrachtAjax\Provider($feedback);
$provider->open();
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
