<?php
	include '../db-connessione-include.php'; //connessione al db-server
	$idlettera = $_GET['idlettera'];
	
	$update = mysql_query(" UPDATE comp_lettera SET vista = 1 WHERE id = $idlettera "); 
	
	if($update) {
		header("Location: login0.php?corpus=home&firma=ok");
	}
	else {
		echo 'Errore nella registrazione dei dati';
	}
?>