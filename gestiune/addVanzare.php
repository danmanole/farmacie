<html>

<head>
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="stylesheet" type="text/css" href="../pageStyle.css">
<script src="../script.js"></script>
</head>
<body>

	<div class="container">

		<div class="logo">
			<img
				src="https://dewey.tailorbrands.com/production/brand_version_mockup_image/17/1787055017_49da261b-2cc0-46bf-9ee4-08a07b96c4f7.png?cb=1552554710">
		</div>

		<div class="bara">
			<ul>
				<li><a href="../index.php">Logout</a></li>
				<li><a href="../client/addClient.php">Adauga client</a></li>
				<li><a href="../reteta/addReteta.php">Adauga reteta</a></li>
				<li><a class="active" href="addVanzare.php">Adauga vanzare</a></li>
				<li><a href="../medicament/addMedicament.php">Adauga medicament</a></li>
				<li><a href="../medicament/listaMed.php">Lista medicamente</a></li>
				<li><a href="../client/listaClienti.php">Lista clienti</a></li>
				<li style="float: right"><a class="active" href="../contact.php">Contact</a></li>
			</ul>
		</div>
	</div>

	<?php
	include_once(dirname(__FILE__) . '/Gestiune.php');
	include_once(dirname(__FILE__) . '/../medicament/Medicament.php');
	include_once(dirname(__FILE__) . '/../reteta/Reteta.php');
    ?>
		
		
		<div><br><br><br><br><br><br>
		<form method="post" id="my_form">
			<legend>Adauga vanzare</legend>
				
	<?php
    \Medicament\coduriSelectMedicament();
    ?>
				
				<label for="cant">Cantitate </label> <input type="text" id="cant"
				name="cant" placeholder=" "> <br>
	<?php
    \Reteta\coduriSelectReteta();
    ?>
				
				<label for="datav">Data vanzare</label> <input type="date"
				id="datav" name="datav"> <br> <input type="submit" value="Submit">


		</form>

			<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    \Gestiune\addVanzare($_POST['cant'], $_POST['codm'], $_POST['codr'], $_POST['datav']);
}

?>
			
		</div>

</body>


</html>