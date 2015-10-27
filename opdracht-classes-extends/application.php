<?php

    function __autoload ( $classname ) {
        
         require_once('/classes/' .$classname. '.php');
        
    }

$animal1 = new Animals( 'Gust', 'Female', 70);

$animal2 = new Animals( 'Ted', 'Male', 100 );

$animal3 = new Animals( 'Lugia', 'Male', 230 );

$lion1 = new Lion( 'Simba', 'Male', 120, 'Congo' );

$lion2 = new Lion ( 'Scar', 'Male', 125, 'Kenia' );

$zebra1 = new Zebra( 'Eddy', 'Male', 15, 'gestreept' );

$zebra2 = new Zebra( 'Freddy', 'Male', 20, 'niet gestreept' );

$animal1->changeHealth(-40);
echo $animal1->getHealth();
echo $animal2->getName();
echo $animal3->getGender();

$nameLion1 = $lion1->getName();
$soortLion1 = $lion1->getSpecies();
$specialmoveLion1 = $lion1->doSpecialMove();

$nameLion2 = $lion2->getName();
$soortLion2 = $lion2->getSpecies();
$specialmoveLion2 = $lion2->doSpecialMove();

$namezebra2 = $zebra2->getName();
$soortzebra2 = $zebra2->getSpecies();
$specialmovezebra2 = $zebra2->doSpecialMove();

$namezebra1 = $zebra1->getName();
$soortzebra1 = $zebra1->getSpecies();
$specialmovezebra1 = $zebra1->doSpecialMove();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p> De speciale move van <?php echo $nameLion1; ?> (soort: <?php echo $soortLion1; ?>): <?php echo $specialmoveLion1; ?></p>
    <p> De speciale move van <?php echo $nameLion2; ?> (soort: <?php echo $soortLion2; ?>): <?php echo $specialmoveLion2; ?></p>
    <p> De speciale move van <?php echo $namezebra2; ?> (soort: <?php echo $soortzebra2; ?>): <?php echo $specialmovezebra2; ?></p>
    <p> De speciale move van <?php echo $namezebra1; ?> (soort: <?php echo $soortzebra1; ?>): <?php echo $specialmovezebra1; ?></p>
</body>
</html>