<?php

session_start();
unset ($SESSION['username']);

if($_SESSION['loginFB']){
	$user=null;
	unset($user);
}

session_destroy();

header('Location: ./#');

?>