<script type="text/javascript" src="email.js"></script>

<?php

	session_start();

	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	include '../db-connessione-include.php';
	include 'maledetti-apici-centro-include.php'; //ATTIVA O DISATTIVA IL MAGIC QUOTE PER GLI APICI
	
	function __autoload ($class_name) { //funzione predefinita che si occupa di caricare dinamicamente tutti gli oggetti esterni quando vengono richiamati
		require_once "class/" . $class_name.".obj.inc";
	}
	
	$q = $_GET['q'];
	$sql = $connessione->query("SELECT nome, cognome, numero FROM anagrafica, jointelefonipersone WHERE (cognome LIKE '%$q%' OR nome LIKE '%$q%' OR numero LIKE '%$q%') AND tipo='envelope-o' AND jointelefonipersone.idanagrafica = anagrafica.idanagrafica LIMIT 10");
	echo '<br><ul>';
	while($row = $sql->fetch()) {
		?>
		<a href="javascript:changeEmail('<?php echo $row['numero'];?>');">
			<?php if($row['numero']) { echo '<li>'. $row['nome'] . ' ' . $row['cognome'] . ' "&lt;' . $row['numero'] . '&gt;" </li>'; } ?>
		</a>
		<?php 
	}
	echo '<ul>';
	$connessione = null;
	
?>

<script type="text/javascript">
  function changeEmail(valore) { 
	email = document.getElementById("email").value;
	if( email != "" ) {
		document.getElementById("email").value = email + ',' + valore;
	}
	else {
		document.getElementById("email").value = valore;
	}
  }
</script>