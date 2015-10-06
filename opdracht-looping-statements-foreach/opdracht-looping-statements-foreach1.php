<?php

/*string file_get_contents ( string $filename [, bool $use_include_path = false [, resource $context [, int $offset = -1 [, int $maxlen ]]]] )
*/

$text = file_get_contents ( "./text-file.txt" );

$textChars = array();
$textLength = strlen( $text );

for( $currentChar = 0; $textLength > $currentChar; $currentChar++) 
{
    
    $textChars[] = substr( $text, $currentChar, 1);
    
}

sort( $textChars );

// array array_reverse ( array $array [, bool $preserve_keys = false ] )

$reversedTextChars = array_reverse ( $textChars );

$arrayCounter = array();

for( $char = 0; $char < $textLength; $char++) {
    
    foreach( $reversedTextChars as $value ) 
    {

        
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
    <p> <?= $text ?> </p>
</body>
</html>