<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//IT" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
	if(!isset($_GET['err'])) {
		$_GET['err'] = 0;
	}
?>
<html>
<head>

<!-- META -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
 <!-- META -->
  
  <!-- CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <!-- CSS -->  
  
  <!-- JS -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- JS -->
  
<title>Abulafia - Login</title>

</head>

<body>

<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<div class="well well-lg"><h1>Abulafia</h1>Gestione delle segreterie dei Volontari della CRI</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" bgcolor="red"><b>LOGIN</b></h3>
  </div>
  <div class="panel-body">
    Per accedere al sistema, inserisci Username e Password:<br><br>
     <?php
    if($_GET['err'] == 1) {
	?>
	<div class="row">
	<div class="col-xs-3">
	<div class="alert alert-danger"> <span class="glyphicon glyphicon-remove"></span> Username o Password errati</div></div></div>
	<?php
   }
   ?>
 
    <form action="login1.php" method="post" role="form">
  <div class="form-group">
    <label>Username</label>
	<div class="row">
	<div class="col-xs-3">
		<input type="text" class="form-control" name="userid" placeholder="username">
	</div>
	</div>
  </div>
  <div class="form-group">
    <label>Password</label>
	<div class="row">
	<div class="col-xs-3">
		<input type="password" class="form-control" name="password" placeholder="password">
	</div>
	</div>
  </div>
  <button type="submit" class="btn btn-default">Accedi</button>
</form>

 </div>
</div>

	<center><h5><small>
	<span xmlns:dc="http://purl.org/dc/elements/1.1/" property="dc:title">
	Abulafia </span> by <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Alfio Musmarra e Biagio Saitta</span> is licensed under a:<br><br>
	<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/it/" target="_blank">
	<img alt="Creative Commons Attribuzione - Non commerciale - Condividi allo stesso modo 2.5 Italia License" style="border-width:0" src="http://creativecommons.org/images/public/somerights20.png" /></a>
	</small></h5></center>

</body>
</html>


