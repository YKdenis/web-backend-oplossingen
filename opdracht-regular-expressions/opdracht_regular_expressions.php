<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 26-12-2015
 * Time: 14:13
 */
$resultString = 'Result: ';
$replaceString = '#';
$errorMessage = '';
$regex = '';
$searchString = '';
$regex1 = '/[a-dA-Du-zU-Z]/';
$regex2 = '/\bcolour\b|\bcolor\b/'; // '/(\W|^)(color|colour)(\W|$)/'
$regex3 = '/\b((1)[0-9]{3})\b/';
$regex4 = '/[a-zA-Z]+/';

if (isset($_POST['action']))
{
    $regex = $_POST['regex'];
    $searchString = $_POST['searchString'];
    if(!empty($regex))
    {
        $updatedString = preg_replace('/' . $regex . '/', $replaceString, $searchString);
        if ($updatedString != $searchString)
        {
            $resultString = $resultString . $updatedString;
        }
        else
        {
            $resultString = 'No matches were found';
        }

    }
    else
    {
        $errorMessage = 'Please fill in a regular expression';
    }
}
else
{
    $errorMessage = 'Er is een probleem opgetreden. Probeer opnieuw.';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>RegEx tester</h1>

<form action="opdracht_regular_expressions.php" method="post">

    <p><?php echo $errorMessage;?></p>

    <ul>
        <li>
            <label for="regex">Regular Expression</label>
            <input type="text" name="regex" id="regex" value="<?php echo isset($regex) ? $regex : ''?>">
        </li>
        <li>
            <label for="searchString">String</label>
            <textarea name="searchString" id="searchString" cols="30" rows="10"><?php echo isset($searchString) ? $searchString : ''?></textarea>
        </li>
    </ul>

    <button name="action">Check</button>

</form>
<?php echo $resultString ?>
</body>
</html>