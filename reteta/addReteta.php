<html>

<head>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../pageStyle.css">
	<script src="../script.js"></script> 
	</head> 
<body>

<div class="container">

	<div class="logo"><img src="https://dewey.tailorbrands.com/production/brand_version_mockup_image/17/1787055017_49da261b-2cc0-46bf-9ee4-08a07b96c4f7.png?cb=1552554710"></div>

	<div class="bara">
		<ul>
		<li><a href="../index.php">Logout</a></li>
		<li><a href="../client/addClient.php">Adauga client</a></li>
		<li><a class="active" href="addReteta.php">Adauga reteta</a></li>
		<li><a href="../gestiune/addVanzare.php">Adauga vanzare</a></li>
		<li><a href="../medicament/addMedicament.php">Adauga medicament</a></li>
		<li><a href="../medicament/listaMed.php">Lista medicamente</a></li>
		<li><a href="../client/listaClienti.php">Lista clienti</a></li>
		<li style="float:right"><a class="active" href="../contact.php">Contact</a></li>
		</ul>
	</div>
		
	

</div>

					<?php 
					include(dirname(__FILE__) . '/../client/Client.php');
					include(dirname(__FILE__) . '/Reteta.php');
					?>
		
		
		<div>
		<br><br><br><br><br><br>
			<form method="post" id="my_form">
				<legend>Adauga reteta</legend>
				
				<label for="doctor">Doctor </label>
				<input type="text" id="doctor" name="doctor" placeholder=" ">
				<br>
				
				<label for="diag">Diagnostic </label>
				<input type="text" id="diag" name="diag" placeholder=" ">
				<br>
				
				
				
				<label for="tip">Tip reteta </label>
				<select id="tip" name="tip">
					<option value="Necompensata">Necompensata</option>
					<option value="Compensata(30%)">Compensata(30%)</option>
					<option value="Compensata(30%)">Compensata(70%)</option>
				</select>
				<br>
				
				<label for="data_elib">Data eliberare</label>
				<input type="date" id="data_elib" name="data_elib">
				<br>
					
					<?php 
					
					\Client\coduriSelectClienti();
					?>
				<input type="submit" value="Submit">
			</form>
			
			<?php  
			
			if($_SERVER['REQUEST_METHOD']=='POST')
           {
			\Reteta\addReteta($_POST['doctor'] ,$_POST['diag'] ,$_POST['tip'] ,$_POST['data_elib'] ,$_POST['codc']);
		   }
			
			?>
			
		
			
		</div>
		
	</body>
 

</html>