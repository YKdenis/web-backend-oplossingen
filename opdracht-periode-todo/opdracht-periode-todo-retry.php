<?php
    session_start();
    
    $array_todo = [];
    $empty_array_notdone = true;
    $empty_array_done = true;
    $message = '';

    function __autoload ( $classname ) {
        
         require_once('/classes/' .$classname. '.php');
        
    }

    if( isset($_POST['addTodo']) ) {
        
        if( isset($_SESSION['todo']) ) {
            $array_todo = $_SESSION['todo'];
        }
        
        if(!empty($_POST['description'])) {
            
            $array_todo[] = new TodoOrNotTodo($_POST['description'], 'not done');
            $_SESSION['todo'] = $array_todo;
            $message = '';
        }
        
        else {
            
            $message = 'Je kan geen lege todo\'s toevoegen!';
        }
        
    }

    if( isset( $_POST['removeNotDone'] )) {
        
        unset($_SESSION['todo'][$_POST['removeNotDone']]);
        $array_todo = $_SESSION['todo'];
        
    }

if( isset( $_POST['removeDone'] ) ) {
    
    unset($_SESSION['todo'][$_POST['removeDone']]);
    $array_todo = $_SESSION['todo'];
}

if( isset($_POST['done'] )) {
    $array_todo = $_SESSION['todo'];
    $array_todo[$_POST['done']]->ChangeStatus();
}

if( isset($_POST['notDone'] )) {
    $array_todo = $_SESSION['todo'];
    $array_todo[$_POST['notDone']]->ChangeStatus();
}

foreach( $array_todo as $id => $value ) {
    
    if( $value->GetStatus() == 'not done' ) {
        $empty_array_notdone = false;
    }
    
    if( $value->GetStatus() == 'done' ) {
        $empty_array_done = false;
    }
    
}

    

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todo App</title>
        <link rel="stylesheet" href="global.css">
    </head>
    <body>
    <?php echo ($message != '' ? $message : ''); ?>
    <h1>Todo app</h1>
    
<?php if(empty($array_todo)) { ?>
   
    <p>Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?</p>
    
<?php } else { ?>
   
    <h2>Nog te doen</h2>
    
<?php if(!$empty_array_notdone)
    {
        foreach( $array_todo as $id => $value ) {
            
            if($value->GetStatus() == 'not done') { ?>
    <form action="opdracht-periode-todo-retry.php" method="POST"> 
                
        <p>
        <button name="done" value="<?php echo $id ?>">Done</button> 
        <?php echo $value->GetValue(); ?>
        <button name="removeNotDone" value="<?php echo $id ?>">remove</button> 
        </p>
        
    </form>           
<?php       }
            
            
        }
    }
    else { ?>
        <p>Goed bezig!</p>
<?php    } ?>
    <!--<?php echo var_dump($array_todo); ?>-->
    <h2>Done is done!</h2>
    
    <?php if(!$empty_array_done)
    {
        
       foreach( $array_todo as $id =>$value ) {
           
           if( $value->GetStatus() == 'done' ) { ?>
               
                <form action="opdracht-periode-todo-retry.php" method="POST"> 
                
                  
                <p>
                <button name="notDone" value="<?php echo $id ?>">Not done</button>
                <?php echo $value->GetValue(); ?>
                <button name="removeDone" value="<?php echo $id ?>">remove</button> 
                </p>
    </form>
               
<?php           }
           
       }
        
    } else { ?>
               <p>Nog niets klaar?</p>
       <?php } ?>
        
    <h1>Todo toevoegen</h1>
    
<?php } ?>
    <form action="opdracht-periode-todo-retry.php" method="POST">

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