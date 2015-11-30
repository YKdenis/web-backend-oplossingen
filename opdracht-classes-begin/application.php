<?php
session_start();

function __autoload( $classname ) {
    
    require_once($classname. '.php');
    // echo 'test';
}

if( isset($_POST['submit']) ) {
    
    $percent = new Percent( $_POST['noemer'], $_POST['teller'] );
    
}
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
            <form method="post" action="application.php">
                <p>Hoeveel procent is
                    <input type="text" id="teller" name="noemer"> van
                    <input type="text" id="noemer" name="teller">?
                </p>

                <tbody>
                    <?php if(!empty($percent)): ?>
                        <tr>
                            <td>Absoluut</td>
                            <td>
                                <?php echo $percent->absolute; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Relatief</td>
                            <td>
                                <?php echo $percent->relative; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Geheel getal</td>
                            <td>
                                <?php echo $percent-> hundred; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nominaal</td>
                            <td>
                                <?php echo $percent->nominal; ?>
                            </td>
                        </tr>
                        <?php endif ?>

                </tbody>

        </table>
        <input type="submit" name="submit" value="Bereken">
        </form>
    </body>

    </html>