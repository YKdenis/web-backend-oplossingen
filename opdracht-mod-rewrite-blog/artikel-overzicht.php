<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28-12-2015
 * Time: 20:20
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form class="query-content">
    <label for="query-content">Zoeken in artikels:</label>
    <input type="text" name="query-content" id="query-content">
    <input type="submit" value="Zoeken">
</form>

<form class="query-date">
    <label for="query-date">Zoeken op datum:</label>
    <select name="query-date" id="query-date">

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
    <input type="submit" value="Zoeken">
</form>

<h1>Artikels overzicht</h1>

<a href="">Artikel toevoegen</a>

</body>
</html>
