<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1>Artikel toevoegen</h1>

    <a href="">Terug naar overzicht</a>

    <form action="artikel-toevoegen.php" method="post">
        <ul>
            <li>
                <label for="titel">Titel</label>
                <input type="text" id="titel" name="titel">
            </li>
            <li>
                <label for="artikel">Artikel</label>
                <textarea id="artikel" name="artikel"></textarea>
            </li>
            <li>
                <label for="kernwoorden">Kernwoorden</label>
                <input type="text" id="kernwoorden" name="kernwoorden">
            </li>
            <li>
                <label for="datum">Datum</label>
                <input type="date" id="datum" name="datum">
            </li>
        </ul>
        <input type="submit" name="submit">
    </form>

</body>

</html>
