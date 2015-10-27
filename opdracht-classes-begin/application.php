<?php

function __autoload( $classname ) {
    
    require_once($classname. '.php');
    // echo 'test';
}

$percent = new Percent( 100, 150 );

// var_dump( $percent );

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <table>
                                <caption>Hoeveel procent is 150 van 100?</caption>
                                <tbody>
                                    <tr>
                                        <td>Absoluut</td>
                                        <td><?php echo $percent->absolute; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Relatief</td>
                                        <td><?php echo $percent->relative; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Geheel getal</td>
                                        <td><?php echo $percent-> hundred; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nominaal</td>
                                        <td><?php echo $percent->nominal; ?></td>
                                    </tr>
                                </tbody>
                            </table>

</body>
</html>