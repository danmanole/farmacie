<html>

	<head>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="../pageStyle.css">
	
	<script src="../script.js"></script> 
	</head> 
	<body>
	<div class="container">

	<div class="logo"><img src="https://dewey.tailorbrands.com/production/brand_version_mockup_image/17/1787055017_49da261b-2cc0-46bf-9ee4-08a07b96c4f7.png?cb=1552554710"></div>

	<div class="bara">
		<ul>
		<li><a href="../index.php">Logout</a></li>
		<li><a class="active" href="addClient.php">Adauga client</a></li>
		<li><a href="../reteta/addReteta.php">Adauga reteta</a></li>
		<li><a href="../gestiune/addVanzare.php">Adauga vanzare</a></li>
		<li><a href="../medicament/addMedicament.php">Adauga medicament</a></li>
		<li><a href="../medicament/listaMed.php">Lista medicamente</a></li>
		<li><a href="listaClienti.php">Lista clienti</a></li>
		<li style="float:right"><a class="active" href="../contact.php">Contact</a></li>
		</ul>
		</div>
	</div>
		

		<div>
			<br><br><br><br><br><br>
			<form method="post" id="my_form">
				<legend>Adauga client</legend>
				
				<label for="nume">Nume </label>
				<input type="text" id="nume" name="nume" placeholder=" ">
				<br>
				
				<label for="prenume">Prenume </label>
				<input type="text" id="prenume" name="prenume" placeholder=" ">
				<br>
				
				<label for="varsta">Varsta</label>
				<input type="text" id="varsta"  name="varsta" onkeypress="isInputNumber(event)">
				<br>
		
				<label for="sex">Sex </label>
				<select id="sex" name="sex">
					<option value="Masculin">Masculin</option>
					<option value="Feminin">Feminin</option>
				</select>
				<br>
	
	
				<input type="submit" value="Submit">
			
			</form>
		
			<?php  
			
			if($_SERVER['REQUEST_METHOD']=='POST')
           {
               include dirname(__FILE__) . '/Client.php';
			
			\Client\addClient($_POST['nume'],$_POST['prenume'],$_POST['sex'],$_POST['varsta']);
			
		   }
			
			?>

		</div>
		
	</body>
 </html>