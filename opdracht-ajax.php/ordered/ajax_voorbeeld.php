<?php
/**
 * Date: 23/12/2015
 * Time: 17:09
 */
var_dump($_REQUEST);
if (isset($_GET['firstName'])) {
    echo 'met ajax verstuurd';
    return;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajax voorbeeld</title>
    <script type="text/javascript" src="../../js/ajax.js"></script>
    <script>
        function contactSubmit()
        {
            var ajax = new Ajax();
            // asynchronous wilt zeggen dat men niet zal wachten op een respons
            // van de server. Men voert de volgende lijnen code al uit.
            ajax.asynchronousFlag = true;
            // postRequest is een callback die een belofte maakt dat wanneer de
            // server iets terug stuurt het zal gestuurd worden naar een bepaalde
            // pagina en afgehandeld zal worden door een bepaalde functie.
            ajax.postRequest('answer.php', 'firstName=Jan&email=jan@kees.com', function (str) { showAnswerFromServer(str) });
            return true;
        }

        function showAnswerFromServer(str)
        {
            document.getElementById('feedback').innerHTML = str;
        }
    </script>
</head>
<body>
<form method="post" action="" id="contact">
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
    <!-- onclick zorgt ervoor wanneer de knop wordt ingedruk contactSubmit() zal worden opgeroepen -->
    <button name="action" value="contact" onclick="contactSubmit(); return false;">Verstuur</button>
</form>
<div id="feedback"></div>
</body>
</html>
