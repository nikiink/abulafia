<?php
session_start();
include '../db-connessione-include.php';

include 'maledetti-apici-centro-include.php'; //ATTIVA O DISATTIVA IL MAGIC QUOTE PER GLI APICI
function __autoload ($class_name) //funzione predefinita che si occupa di caricare dinamicamente tutti gli oggetti esterni quando vengono richiamati
{ require_once "class/" . $class_name.".obj.inc";
}
$q=$_GET['q'];

//$id=$_GET['id'];

$sql=mysql_query("SELECT * FROM anagrafica WHERE cognome like '%$q%' and tipologia='persona' limit 5");






while($row = mysql_fetch_array($sql))
  {
echo "<br>";?>
<a href="login0.php?corpus=gestione-utenti-aggiungi-utente2&id=<?php echo $row['idanagrafica'];?>&cognome=<?php echo $row['cognome'];?>&nome=<?php echo $row['nome'];?>">
<?php echo $row['cognome'].' '.$row['nome'];?></a>

<?php echo "<br>";
  }


mysql_close ($verificaconnessione);

?>
