<?php

function __autoload ($classname) {
    
    require_once('/classes/' .$classname. '.php');
    
}

$htmlbuilderHeader = new HTMLBuilder( 'header-partial', '.php' );

$bestandsnaamHeader = $htmlbuilderHeader->getBestandsnaam();
echo $bestandsnaamHeader;
$htmlbuilderHeader->buildHeader($bestandsnaamHeader);

$htmlbuilderBody = new HTMLBuilder ( 'body-partial', '.php' );

$bestandsnaamBody = $htmlbuilderBody->getBestandsnaam();
$htmlbuilderBody->buildBody($bestandsnaamBody);

$htmlbuilderFooter = new HTMLBuilder ( 'footer-partial', '.php' );

$bestandsnaamFooter = $htmlbuilderFooter->getBestandsnaam();
$htmlbuilderFooter->buildFooter($bestandsnaamFooter);
                 
?>