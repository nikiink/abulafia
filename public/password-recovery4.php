<?php

	session_start(); //avvio della sessione per caricare le variabili

	if (isset($_SESSION['auth']) && $_SESSION['auth'] > 1 ) {
        header("Location: login0.php?corpus=home");
    }
	
	$password = md5($_POST['pass1']); // nome utente inserito nella form della pagina iniziale
	$idutente = $_POST['idutente']; // password inserita nella form della pagina iniziale
	
	include '../db-connessione-include.php'; //connessione al db-server
	include 'maledetti-apici-centro-include.php'; //ATTIVA O DISATTIVA IL MAGIC QUOTE PER GLI APICI

	$pass = mysql_query("UPDATE users SET password = '$password' WHERE idanagrafica = '$idutente'");
	
	if($pass) {
		$delete = mysql_query("DELETE FROM passwordrecovery WHERE utente = '$idutente'")
		?>
		<script>
			window.location="index.php?change=ok";
		</script>
		<?php
	}
	else {
		?>
		<script>
			window.location="index.php?change=error";
		</script>
		<?php
	}

?>

