<div class="row">
	
	<div class="col-sm-12">
		<div class="panel panel-default">
			
				<div class="panel-heading">
					<h3 class="panel-title"><strong><i class="fa fa-plus-circle"></i> Aggiungi Prodotto</strong></h3>
				</div>
				
				<div class="panel-body">
					
					<?php
					 if( isset($_GET['insert']) && $_GET['insert'] == "ok") {
					?>
					<div class="row">
						<div class="col-sm-12">
							<div class="alert alert-success"><i class="fa fa-check"></i> Prodotto inserito <b>correttamente!</b></div>
						</div>
					</div>
					<?php
					}
					?>
				
					<form class="form-horizontal" role="form" name="modulo" method="post" action="magazzino-aggiungi-prodotto2.php">

						<div class="form-group">
							<label class="col-sm-3 control-label">Descrizione Prodotto:</label>
							<div class="row">
								<div class="col-sm-8">
									<input type="text" class="form-control input-sm" name="descrizione" required>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Prezzo:</label>
							<div class="row">
								<div class="col-sm-2">
									<div class="input-group">
										<input type="text" class="form-control input-sm" name="prezzo"><div class="input-group-addon"><i class="fa fa-euro"></i></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Unit&agrave; di Misura:</label>
							<div class="row">
								<div class="col-sm-2">
									<select class="form-control input-sm"  size=1 cols=4 NAME="unitadimisura">
										<option value="PZ"> PZ </option>
										<option value="BX"> BX </option>
										<option value="UNI"> UNI </option>
										<option value="CPR"> CPR </option>
										<option Value="FL"> FL </option>
										<option value="FLC"> FLC </option>
										<option value="CFZ"> CFZ </option>
										<option value="TB"> TB </option>
										<option value="LT"> LT </option>
										<option value="KG"> KG </option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Note:</label>
							<div class="row">
								<div class="col-sm-8">
									<input type="text" class="form-control input-sm" name="note">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Codice a Barre:</label>
							<div class="row">
								<div class="col-sm-5">
									<input type="text" class="form-control input-sm" name="codicebarre">
								</div>
							</div>
						</div>
						
						<br>
						<div class="row">
							<div class="col-sm-2 col-sm-offset-3">
								<button class="btn btn-lg btn-success" type="submit"><span class="glyphicon glyphicon-check"></span> Inserisci</button>
							</div>
						</div>
					
					</form>
				
				</div>
		</div>
	</div>
	
</div>