<?php

	session_start();

	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	include '../db-connessione-include.php'; //connessione al db-server
	$idlettera = $_GET['id'];
	$from = $_GET['from'];
	
	$update = mysql_query(" UPDATE comp_lettera SET vista = 2 WHERE id = $idlettera "); 
	
	if($update) {
		header("Location: login0.php?corpus=".$from);
	}
	else {
		echo 'Errore nella registrazione dei dati';
	}
?>