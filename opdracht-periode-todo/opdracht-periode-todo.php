<?php
    session_start();
    
    $titleTodo;
    $errorMessage = "";
    $todoArray = [];
    $todoArrayLength = 0;
    $isDoneArray = [];
    $isDoneArrayLength = 0;

    if( isset( $_POST['addTodo']) ) {
        
        if( isset( $_SESSION['todo'] ) ) {
                $todoArray = $_SESSION['todo'];
            }
        
        if( isset($_SESSION['isDone'])) {
                $isDoneArray = $_SESSION['isDone'];
                
            }
            
        if( $_POST['description'] != '' ) {
            
            $errorMessage = '';
            array_push($todoArray, $_POST['description']);
            $_SESSION['todo'] = $todoArray;
            
        }
        else {
            $errorMessage = "Lege todo's zijn niet toegestaan!";
        }
        
        $isDoneArrayLength = sizeof($isDoneArray);
        $todoArrayLength = sizeof($todoArray);
    }
    
    if(isset( $_GET['remove'] )) {
//        print_r($_SESSION['todo']);
        unset($_SESSION['todo'][$_GET['remove']]);
        
        foreach( $_SESSION['todo'] as $value ) {
            $todoArray[] = $value;
        }
        
        if( isset($_SESSION['isDone'])) {
            $isDoneArray = $_SESSION['isDone'];    
        }
        
        $_SESSION['todo'] = $todoArray;
        $todoArrayLength = sizeof($todoArray);
        $isDoneArrayLength = sizeof($isDoneArray);
    }

    if(isset( $_GET['done'])) {
        
        if(isset( $_SESSION['isDone'] ) ) {
            
            $isDoneArray = $_SESSION['isDone'];
            
        }
        
        array_push($isDoneArray, $_SESSION['todo'][$_GET['done']]);
        unset($_SESSION['todo'][$_GET['done']]);
        
        foreach( $_SESSION['todo'] as $val ) {
            $todoArray[] = $val;
        }
        
        $_SESSION['todo'] = $todoArray;
        $todoArrayLength = sizeof($todoArray);
        $isDoneArrayLength = sizeof($isDoneArray);
        $_SESSION['isDone'] = $isDoneArray;
        
        /*print_r($_SESSION['todo']);
        print_r($_SESSION['isDone']);*/
        
    }

    if(isset( $_GET['notDone'] )) {
        
        $_SESSION['todo'][] = $_SESSION['isDone'][$_GET['notDone']];
        unset($_SESSION['isDone'][$_GET['notDone']]);
        
        foreach( $_SESSION['isDone'] as $value) {
            
            $isDoneArray[] = $value;
            
        }
        
        $_SESSION['isDone'] = $isDoneArray;
        $todoArray = $_SESSION['todo'];
        $todoArrayLength = sizeof($todoArray);
        $isDoneArrayLength = sizeof($isDoneArray);
        
    }
    
    if(isset( $_GET['removeDone'] )) {
        
        unset($_SESSION['isDone'][$_GET['removeDone']]);
        
        foreach( $_SESSION['isDone'] as $value ) {
            
            $isDoneArray[] = $value;
            
        }
        
        if( isset($_SESSION['todo'] ) ) {
            $todoArray = $_SESSION['todo'];
        }
        
        $_SESSION['isDone'] = $isDoneArray;
        $todoArrayLength = sizeof($todoArray);
        $isDoneArrayLength = sizeof($isDoneArray);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todo App</title>
        <link rel="stylesheet" href="global.css">
    </head>
    <body>
       
       
       
        <p><?php echo $errorMessage?></p>
        
        <h1>Todo app</h1>
                    <?php if(empty($_SESSION['todo']) && empty($_SESSION['isDone']) ) { ?>
					<p>Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?</p>
					<?php } 
                    else { ?>
                           <h2>Nog te doen</h2>

                            <?php if(!empty($_SESSION['todo']) ) { ?>

                                <?php for($i = 0; $i < $todoArrayLength; $i++) { ?>
                                    <p>
                                    <a href="opdracht-periode-todo.php?done=<?php echo $i ?>">Done</a>
                                    <?php echo $todoArray[$i] ?>
                                   <a href="opdracht-periode-todo.php?remove=<?php echo $i ?>">remove</a>
                                   <p>
                               <?php } ?>

                            <?php } else { ?>
                                <p>Je bent klaar met alles!</p>
					        <?php } ?>
					        
					   <h2>Done and done!</h2>
					   
                           <?php if(!empty($_SESSION['isDone'] )) { ?>

                               <?php for($i = 0; $i < $isDoneArrayLength; $i++) { ?>
                                    <p>
                                    <a href="opdracht-periode-todo.php?notDone=<?php echo $i ?>">Not done</a>
                                    <?php echo $_SESSION['isDone'][$i] ?>
                                   <a href="opdracht-periode-todo.php?removeDone=<?php echo $i ?>">remove</a>
                                   <p>

                           <?php } ?>
					   <?php } else { ?>
                               <p>Je hebt nog niets gedaan.</p>
                            <?php } ?>
					   
					   
					   
					   
					<?php } ?>
		<form action="opdracht-periode-todo.php" method="POST">
		
		<h1>Todo toevoegen</h1>

			<ul>
				<li>
					<label for="description">Beschrijving: </label>
					<input type="text" id="description" name="description">
				</li>
			</ul>

			<input type="submit" name="addTodo" value="Toevoegen">

		</form>
    </body>
</html>