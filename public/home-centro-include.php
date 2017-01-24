<?php
	include("lib/pchart/pChart/pData.class");  
	include("lib/pchart/pChart/pChart.class"); 
	
	if(isset($_GET['pass']) && ($_GET['pass'] == 1)) {
		echo '<center><div class="alert alert-warning"><h3><b><i class="fa fa-exclamation-triangle"></i> Attenzione:</b> non hai ancora modificato la tua password di default!</h3>
			Per questioni di sicurezza ti invitiamo a cambiarla al pi&ugrave; presto. <a href="?corpus=cambio-password&loginid='. $_SESSION['loginid'] . '">Cambia la tua password ora</a></div></center>';
	}
	
	$_SESSION['block'] = false;
	$data = new Calendario();
	$lettera = new Lettera();
	$e = new Mail();
	$a = new Anagrafica();
	
	$anno = $_SESSION['annoprotocollo'];
	$annoprotocollo = $_SESSION['annoprotocollo'];
	$statslettere=mysql_query("select count(*) from lettere$annoprotocollo where datalettera != '0000/00/00'");
	$res_lettere = mysql_fetch_row($statslettere);
	$ricevute=mysql_query("select count(*) from lettere$annoprotocollo where datalettera != '0000/00/00' and speditaricevuta='ricevuta'");
	$ric = mysql_fetch_row($ricevute);
	$spedite=mysql_query("select count(*) from lettere$annoprotocollo where datalettera != '0000/00/00' and speditaricevuta='spedita'");
	$sped = mysql_fetch_row($spedite);
	$ultimoprot = $lettera->ultimoId($anno);
	
	//patch protocolli saltati
	if ($_SESSION['auth'] < 90) {
		$protocollatore = $_SESSION['loginid'];
		$query_prot_count = mysql_query("SELECT COUNT(lettere$anno.idlettera) FROM lettere$anno, joinlettereinserimento$anno WHERE lettere$anno.oggetto = '' AND joinlettereinserimento$anno.idinser = $protocollatore AND lettere$anno.idlettera = joinlettereinserimento$anno.idlettera");
		$query_prot = mysql_query("SELECT lettere$anno.idlettera FROM lettere$anno, joinlettereinserimento$anno WHERE lettere$anno.oggetto = '' AND joinlettereinserimento$anno.idinser = $protocollatore AND lettere$anno.idlettera = joinlettereinserimento$anno.idlettera ORDER BY lettere$anno.idlettera ASC");
	}
	else {
		$query_prot_count = mysql_query("SELECT idlettera FROM lettere$anno WHERE lettere$anno.oggetto = '' ");
		$query_prot = mysql_query("SELECT idlettera FROM lettere$anno WHERE lettere$anno.oggetto = '' ORDER BY lettere$anno.idlettera ASC");
	}
	
	$result = mysql_fetch_row($query_prot_count);
	
	if ($result[0] > 0) {
		?>
		<h3><center><div class="alert alert-danger"><b><i class="fa fa-exclamation-triangle"></i> Attenzione:</b> &egrave; stata rilevata un'anomalia nel registro di protocollo.
		<h5>Alcune lettere non sono state registrate correttamente. Clicca sui numeri per inserire i dettagli mancanti: 
		<?php
		while ($idprot = mysql_fetch_array($query_prot)){
			?>
			<a href="?corpus=modifica-protocollo&from=correggi&id=<?php echo $idprot['idlettera']; ?>"><?php echo $idprot['idlettera'].';'; ?> 
			<?php
		}
		?>
		</a></h5></div></center></h3>
		<?php
	}
	
	if (isset($_GET['firma']) &&($_GET['firma'] == 'ok')) {
		?>
		<center><h3><div class="alert alert-success"><i class="fa fa-check"></i> Lettera sottoposta alla firma <b>correttamente!</b></div></h3></center>
		<?php
	}
	
	if (isset($_GET['email']) &&($_GET['email'] == 'ok')) {
		?>
		<center><h4><div class="alert alert-info"><i class="fa fa-check"></i> Impostazioni server mail salvate <b>correttamente!</b></div></h4></center>
		<?php
	}
	
	if (!$e->isSetMail()) {
		?>
		<center><h4><div class="alert alert-warning"><i class="fa fa-warning"></i> <b>Attenzione:</b> per poter inviare email bisogna configurare il server mail in <a href="?corpus=server-mail">questa pagina</a>.</div></h4></center>
		<?php
	}
	
	if (isset($_GET['aggiornamento']) && ($_GET['aggiornamento'] == 'ok')) {
		?>
		<center><div class="alert alert-info">
			<h3><b><i class="fa fa-refresh"></i> Aggiornamento di Sistema - Ver. 10.0</b></h3>
			<br><b>Modifiche introdotte con l'aggiornamento:</b>
			<br> - scissione pagina di ricerca;  &egrave; adesso possibile ricercare solo i protocolli o solo le anagrafiche mediante i sottomenu "protollo" e "anagrafica";
			<br> - scissione delle lettere tra "lettere in lavorazione" e "lettere archiviate";
			<br><br><small>Se notate anomalie o malfunzionamenti comunicateceli mediante la <a href="login0.php?corpus=segnala-bug">pagina di segnalazione errori.</a></small>
		</center>
		<?php
	}
	?>
	
<hr>
	<center>
		<h2>
			<div class="row">
				<div class="col-sm-3">
					<i class="fa fa-calendar"></i> Anno:<b> <?php echo $anno; ?></b>
				</div>
				<div class="col-sm-6">
					<i class="fa fa-book"></i> Numero di protocollo attuale:<b> <?php echo $ultimoprot; ?></b>
				</div>
				<div class="col-sm-3">
					<i class="fa fa-arrow-down"></i> <b> <?php echo $ric[0]; ?></b> <i class="fa fa-arrow-up"></i> <b> <?php echo $sped[0]; ?></b>
				</div>
			</div>
		</h2>
	</center>
<hr>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><strong><span class="glyphicon glyphicon-stats"></span> Stats:</strong></h3>
	</div>
			
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<?php 
				//Utilizzo Abulafia
				$anniusoapplicazione = (strtotime("now") - strtotime("2008/4/1"))/60/60/24/365;
				$giorniusoapplicazione = ((strtotime("now") - strtotime("2008/4/1"))/60/60/24)-(int)$anniusoapplicazione*365;
				
				/*echo 'La Web-Application Abulafia e\' in uso da '; 
				
				if( (int)$anniusoapplicazione > 0) { 
					echo (int)$anniusoapplicazione . ' anni e ' .(int)$giorniusoapplicazione.' giorni.'; 
				} 
				else { 
					echo (int)$giorniusoapplicazione.' giorni.'; 
				} 
				*/
				?>
				
				
				<p>
				<?php 
				//Utilizzo comitato
				$anniusoapplicazione = (strtotime("now") - strtotime($_SESSION['inizio']))/60/60/24/365;
				$giorniusoapplicazione = ((strtotime("now") - strtotime($_SESSION['inizio']))/60/60/24)-(int)$anniusoapplicazione*365;
				echo $_SESSION['nomeapplicativo'] . ' e\' in uso da '; 
						
				if( (int)$anniusoapplicazione > 0) { 
					echo (int)$anniusoapplicazione . ' anni e ' .(int)$giorniusoapplicazione.' giorni.'; 
				} 
				else { 
					echo (int)$giorniusoapplicazione.' giorni.'; 
				} 
				
				?>
				</p>
				<p>
				<?php 
				$DataSet = new pData;  
				 
				if ($res_lettere[0] > 0) {
					$statsusers1=mysql_query("SELECT COUNT(joinlettereinserimento$anno.idinser) AS numerolettere, anagrafica.cognome, anagrafica.nome FROM anagrafica, joinlettereinserimento$anno WHERE  joinlettereinserimento$anno.idinser = anagrafica.idanagrafica AND datamod != '0000/00/00' GROUP BY anagrafica.idanagrafica ORDER BY numerolettere DESC");
					echo mysql_error();
					echo 'Sono state registrate ' . $res_lettere[0] . ' lettere, nel dettaglio:<br><br>';
					while ($statsusers2= mysql_fetch_array($statsusers1)) {
							$statsusers2 = array_map('stripslashes', $statsusers2);
							echo $statsusers2['numerolettere'] . ' inserite da '. ucwords(strtolower($statsusers2['nome'] . ' ' . $statsusers2['cognome'])) . ';<br>';
							$DataSet->AddPoint($statsusers2['numerolettere'],"Serie1");  
							$DataSet->AddPoint(ucwords(strtolower($statsusers2['nome'] . ' ' . $statsusers2['cognome'])),"Serie2");
					}
					$DataSet->AddAllSeries();  
					$DataSet->SetAbsciseLabelSerie("Serie2");  
							 
					// Initialise the graph  
					$Test = new pChart(450,200);  
					$Test->drawFilledRoundedRectangle(7,7,373,193,5,240,240,240);  
					$Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);  
								  
					// Draw the pie chart  
					$Test->setFontProperties("lib/pchart/Fonts/tahoma.ttf",8);  
					$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),150,90,110,PIE_PERCENTAGE,TRUE,50,20,5);  
					$Test->drawPieLegend(310,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);  
						  
					$Test->Render("graphs/homegraph.png");  
		
					?>
					</p>
					<center><img src="graphs/homegraph.png"></center><br>
					<?php
				}
				?>
			</div>
			<div class="col-sm-6">
				<?php
				$DataSet = new pData;
					
				$statsanagrafica=mysql_query("select count(*) from anagrafica");
				$res_anagrafica = mysql_fetch_row($statsanagrafica);
				echo 'Nella tabella ANAGRAFICA sono presenti '.($res_anagrafica[0]) .' occorrenze, di cui:<br><br>';
					
				$my_anagrafica->publcontaanagrafica('persona');
				echo $my_anagrafica->contacomponenti.' Persone Fisiche;<br>';
				$DataSet->AddPoint($my_anagrafica->contacomponenti,"Serie1");
				
				$my_anagrafica->publcontaanagrafica('carica');
				echo $my_anagrafica->contacomponenti.' Cariche o Incarichi;<br>';
				$DataSet->AddPoint($my_anagrafica->contacomponenti,"Serie2");
				
				$my_anagrafica->publcontaanagrafica('ente');
				echo $my_anagrafica->contacomponenti.' Enti;<br>';
				$DataSet->AddPoint($my_anagrafica->contacomponenti,"Serie3");
					
				$my_anagrafica->publcontaanagrafica('fornitore');
				echo $my_anagrafica->contacomponenti.' Fornitori;';
				$DataSet->AddPoint($my_anagrafica->contacomponenti,"Serie4");
					  
				$DataSet->AddAllSeries();  
				$DataSet->SetSerieName("Persone Fisiche","Serie1");  
				$DataSet->SetSerieName("Cariche o Incarichi","Serie2");  
				$DataSet->SetSerieName("Enti","Serie3");
				$DataSet->SetSerieName("Fornitori","Serie4");
				  
				// Initialise the graph  
				$Test = new pChart(500,230);  
				$Test->setFontProperties("lib/pchart/Fonts/tahoma.ttf",8);  
				$Test->setGraphArea(50,30,400,200);  
				$Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
				$Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
				$Test->drawGraphArea(255,255,255,TRUE);  
				$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);     
				$Test->drawGrid(4,TRUE,230,230,230,50);  
					  
				// Draw the 0 line  
				$Test->setFontProperties("lib/pchart/Fonts/tahoma.ttf",6);  
				$Test->drawTreshold(0,143,55,72,TRUE,TRUE);  
				  
				// Draw the bar graph  
				$Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);  
					  
				// Finish the graph  
				$Test->setFontProperties("lib/pchart/Fonts/tahoma.ttf",8);  
				$Test->drawLegend(370,15,$DataSet->GetDataDescription(),255,255,255);  
				$Test->setFontProperties("lib/pchart/Fonts/tahoma.ttf",10);  
				$Test->Render("graphs/anagrafica.png");  
				
				?>
				<br><br>
				<center><img src="graphs/anagrafica.png"></center>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
		
			<div class="panel-heading">
				<h3 class="panel-title"><strong><i class="fa fa-list-ul"></i> Ultimi protocolli registrati:</strong></h3>
			</div>
			
			<div class="panel-body">
				<?php
					$risultati = $lettera->ultimeLettere(5, $anno);
				?>
				<table class="table table-striped" width="100%">
				<?php
				if($risultati) {
					echo "<tr><td></td><td><b>NUM.</b></td><td><b>DATA</b></td><td><b>OGGETTO</b></td><td></td></tr>";
					foreach ($risultati as $val) {
						if($val[3]=='spedita') {
							$icon = '<i class="fa fa-arrow-up"></i>';
						}
						else {
							$icon = '<i class="fa fa-arrow-down"></i>';
						}
						echo "<tr><td>".$icon."</td><td>".$val[0]."</td><td>".$data->dataSlash($val[1])."</td><td>".$val[2]."</td>
							<td width='55'><a href=\"?corpus=dettagli-protocollo&id=".$val[0]."&anno=".$anno."\">Vai <i class=\"fa fa-share\"></i></td></tr>";
					}
				}
				?>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-hdd-o"></i> Quota su disco:</strong></h3>
	</div>
			
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-12">
				<?php
				$file = new File();
				$dim =  round($file->sizeDirectory("../public/") / (1024*1024), 2) ;
				$max = $_SESSION['quota'];
				$percentuale = ( $dim / $max ) * 100;
				if($percentuale <=50)
					$class = "progress-bar-success";
				else if($percentuale <=80)
					$class = "progress-bar-warning";
				else
					$class = "progress-bar-danger";
				?>
				<div class="progress">
					<div class="progress-bar <?php echo $class; ?>" role="progressbar" aria-valuenow="<?php echo $dim; ?>" aria-valuemin="0" aria-valuemax="<?php echo $max; ?>" style="width: <?php echo $percentuale; ?>%;"></div>
				</div>
				<center><?php echo $file->unitaMisura($dim).' su ' . $file->unitaMisura($max) . ' (' . round($percentuale,3).'%)'; ?></center>
			</div>
		</div>
	</div>
</div>

<?php 
if($a->isAdmin($_SESSION['loginid'])) { ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><strong><span class="glyphicon glyphicon-calendar"></span> Log degli ultimi 5 accessi:</strong></h3>
				</div>
						
				<div class="panel-body">
					<p><?php $my_log -> publleggilog('1', '5', 'login', $_SESSION['logfile']); //legge dal log degli accessi ?></p>
				</div>
			</div>
		</div>
	</div>
	<?php
}	
$my_log -> publscrivilog( $_SESSION['loginname'], 'GO TO HOME' , 'OK' , $_SESSION['ip'], $_SESSION['historylog']);
?>