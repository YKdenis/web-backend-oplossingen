<?php
$action = 'none';
if (isset($_POST['action'])) // postback de gebruiker heeft op een button element geklikt
{
    $action = $_POST['action'];
    switch ($action) {
        case 'contact' :
            // connectie met de database maken
            // om een reactie van de gebruiker in de tabel te inserten
            require('../../amen/mysql/src/Connection.php');
            require('../../amen/dialog/autoload.php');
            require('Provider.php');
            require('contact_model.php');
            $feedback = new \Amen\Dialog\Model\Feedback();
            $feedbackView = new \Amen\Dialog\View\Feedback($feedback);
            $provider = new OpdrachtAjax\Provider($feedback);
            $provider->open();
            $contactModel = new ContactModel($provider->getPdo(), $feedback);

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $contactModel->setEmail($_POST['email']);
            } else {
                $feedback->setText('The email you have entered is invalid.');
                $feedback->setName('invalid email');
                $feedback->setCode('VALIDATION');
                $action = 'none';
            }

            if (empty($_POST['message'])) {
                $feedback->setText('The message may not be empty.');
                $feedback->setName('invalid message');
                $feedback->setCode('VALIDATION');
                $action = 'none';
            } else {
                $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
                $contactModel->setMessage($message);
            }
            // Alleen als bovenstaande if's zijn doorlopen zal $action nog op
            // 'contact' staan. Dan pas zal de methode create worden uitgevoerd.
            if ($action == 'contact') {
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
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <script type="text/javascript" src="app/js/ajax.js"></script>
</head>
<body>
<h1>Contacteer ons</h1>

<form action="contact_form.php" method="post">
    <div style="color: green">
        <?php isset($_POST['action']) ? $feedbackView->outputValidation() : ''; ?>
    </div>
    <ul>
        <li>
            <label for="email">E-mailadres</label>
            <input type="text" id="email" name="email">
        </li>
        <li>
            <label for="message">Boodschap</label>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
        </li>
        <li>
            <input type="checkbox" name="copy" id="copy">
            <label for="copy">Stuur een kopie naar mezelf</label>
        </li>
    </ul>
    <!-- de value is de waarde dat meegegeven wordt met de $_POST['action'] indien er
    er op de button wordt geklikt -->
    <button name="action" value="contact">Verstuur</button>
</form>
<div class="feedback">
    <?php isset($_POST['action']) ? $feedbackView->output() : ''; ?>
</div>
</body>
</html>
