<?php
session_start();

function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

User::logout();

$logout = new Message("notification", "Untill next time!");

header('location: login-form.php');

?>