<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="pageStyle.css">
<script src="script.js"></script> 
</head> 
<body>
<div class="container">

	<div class="logo"><img src="https://dewey.tailorbrands.com/production/brand_version_mockup_image/17/1787055017_49da261b-2cc0-46bf-9ee4-08a07b96c4f7.png?cb=1552554710"></div>

	<div class="bara">
		<ul>
		<li><a class="active"  href="index.php">Logout</a></li>
		<li><a href="./client/addClient.php">Adauga client</a></li>
		<li><a href="./reteta/addReteta.php">Adauga reteta</a></li>
		<li><a href="./gestiune/addVanzare.php">Adauga vanzare</a></li>
		<li><a href="./medicament/addMedicament.php">Adauga medicament</a></li>
		<li><a href="./medicament/listaMed.php">Lista medicamente</a></li>
		<li><a href="./client/listaClienti.php">Lista clienti</a></li>
		<li style="float:right"><a class="active" href="contact.php">Contact</a></li>
		</ul>
	</div>
	<br><br><br><br>
		
	<?php  
	include dirname(__FILE__) . '/./gestiune/Gestiune.php';
	\Gestiune\printVanzare();
	?>

</div>

</body>
</html>
