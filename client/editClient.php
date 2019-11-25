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
		<li><a href="addClient.php">Adauga client</a></li>
		<li><a href="../reteta/addReteta.php">Adauga reteta</a></li>
		<li><a href="../gestiune/addVanzare.php">Adauga vanzare</a></li>
		<li><a href="../medicament/addMedicament.php">Adauga medicament</a></li>
		<li><a  href="../medicament/listaMed.php">Lista medicamente</a></li>
		<li><a class="active" href="listaClienti.php">Lista clienti</a></li>
		<li style="float:right"><a class="active" href="../contact.php">Contact</a></li>
		</ul>
	</div>

</div>

		<?php
		include dirname(__FILE__) . '/Client.php';
	
		$codc = $_GET['codc'];
		$v=\Client\getClientDet($codc);
		
			$nume =$v[0];
			$prenume =$v[1];
			$sex =$v[2];
			$varsta =$v[3];
			
		?>
		
		<div>
		<br><br><br><br><br><br>
			<form method="post" id="my_form" >
				<legend>Editeaza Client</legend>
				
				<label for="codc">Cod client </label>
				<input type="text" id="codc" name="codc" placeholder=" " value="<?php echo $codc ?> " readonly>
				<br>
				
				<label for="nume">Nume</label>
				<input type="text" id="nume" name="nume" placeholder=" " value="<?php echo $nume ?> ">
				<br>
				
				<label for="prenume">Prenume </label>
				<input type="text" id="prenume"  name="prenume" placeholder=" " value="<?php echo $prenume ?> ">
				<br>
				
				<select id="sex" name="sex">
					<option value="Masculin">Masculin</option>
					<option value="Feminin">Feminin</option>
				</select>
				<br>
				
				<label for="varsta">Varsta</label>
				<input type="text" id="varsta"  name="varsta"  onkeypress="isInputNumber(event)" value="<?php echo $varsta ?> ">
				<br>
				
				<input type="submit" value="Submit">
				
					 
			</form>
			
		<?php
			
			
           if($_SERVER['REQUEST_METHOD']=='POST')
           {
		
			$codc=$_POST['codc'];
			$nume =$_POST['nume'];
			$prenume =$_POST['prenume'];
			$sex =$_POST['sex'];
			$varsta =$_POST['varsta'];
			
			\Client\updateClient($codc,$nume,$prenume,$sex,$varsta);
			header("Location:listaClienti.php");
			
		   }
			?>
	
		
		</div>
		
	</body>

</html>