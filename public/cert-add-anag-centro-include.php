<?php

	if( isset($_GET['insert']) && $_GET['insert'] == "ok") {
		?>
		<div class="row">
			<div class="col-sm-12">
				<center><div class="alert alert-success"><i class="fa fa-check"></i> Assistito inserito <b>correttamente!</b></div></center>
			</div>
		</div>
		<?php
	}
?>

<div class="panel panel-default">
	
	<div class="panel-heading">
		<h3 class="panel-title"><strong><i class="fa fa-user-plus"></i> Inserimento di un Assistito</strong></h3>
	</div>
		
	<div class="panel-body">

		<form class="form-horizontal" action="cert-add-anag2.php" role="form" name="modulo" method="post" >
						
			<div class="form-group">
				<div class="row">
					
					<label class="col-sm-2 control-label">Nome:</label>
					<div class="col-sm-2">
						<input type="text" class="form-control input-sm" name="nome" required>
					</div>

					<label class="col-sm-1 control-label">Cognome:</label>
					<div class="col-sm-2">
						<input type="text" class="form-control input-sm" name="cognome" required>
					</div>

					<label class="col-sm-2 control-label">Codice Fiscale:</label>
					<div class="col-sm-2">
						<input type="text" class="form-control input-sm" name="codicefiscale" required>
					</div>
				
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					
					<label class="col-sm-2 control-label">Nato a:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control input-sm" name="cittanascita" required>
					</div>

					<label class="col-sm-1 control-label">il:</label>
					<div class="col-sm-2">
						<input type="text" class="form-control input-sm datepickerAnag" name="datanascita" required>
					</div>
				
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					
					<label class="col-sm-2 control-label">Residente a:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control input-sm" name="residenzacitta" required>
					</div>

					<label class="col-sm-1 control-label">Via/Piazza:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control input-sm" name="residenzavia" required>
					</div>

					<label class="col-sm-1 control-label">N:</label>
					<div class="col-sm-1">
						<input type="text" class="form-control input-sm" name="residenzanumero" required>
					</div>
				
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					
					<label class="col-sm-2 control-label">Documento:</label>
					<div class="col-sm-3">
						<select class="form-control input-sm" name="documento">
							<option selected value="cartaidentita"> Carta d'identi&agrave;</option>
							<OPTION value="patente"> Patente di guida</option>
							<OPTION value="passaporto"> Passaporto</option>
						</select>
					</div>

					<label class="col-sm-1 control-label">N:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control input-sm" name="documentonumero" required>
					</div>
				
				</div>
			</div>
						
			<br>
			<div class="row">
				<center>
					<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-check"></i> Inserisci</button>
				</center>
			</div>
		
		</form>
				
	</div>
</div>