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
		<li><a href="../reteta/addReteta.php">Adauga reteta</a></li>
		<li><a href="../gestiune/addVanzare.php">Adauga vanzare</a></li>
		<li><a class="active" href="addMedicament.php">Adauga medicament</a></li>
		<li><a href="listaMed.php">Lista medicamente</a></li>
		<li><a href="../client/listaClienti.php">Lista clienti</a></li>
		<li style="float:right"><a class="active" href="../contact.php">Contact</a></li>
		</ul>
	</div>
		
</div>

		<div>
		<br><br><br><br><br><br>
			<form method="post" id="my_form">
				<legend>Adauga medicament</legend>
				
				<label for="prod">Producator </label>
				<input type="text" id="prod" name="prod" placeholder=" ">
				<br>
				
				<label for="den">Denumire </label>
				<input type="text" id="den"  name="den" placeholder=" ">
				<br>
				
				<label for="pret">Pret</label>
				<input type="text" id="pret"  name="pret" onkeypress="isInputNumber(event)">
				<br>
				
				<label for="stoc">Stoc</label>
				<input type="text" id="stoc"  name="stoc" onkeypress="isInputNumber(event)">
				<br>
				
				<label for="data_exp">Data expirare</label>
				<input type="date" id="data_exp" name="data_exp">
				<br>
				
				<label for="prescriptie">Prescriptie </label>
				<select id="prescriptie" name="prescriptie">
					<option value="Da">Da</option>
					<option value="Nu">Nu</option>
				
				</select>
				<br>
				
				<label for="nat_exp">Natura excipient </label>
				<input type="text" id="nat_exp" name="nat_exp" placeholder=" ">
				<br>
				
				<label for="nat_suba">Natura substanta activa </label>
				<input type="text" id="nat_suba" name="nat_suba" placeholder=" ">
				<br>
				
				<label for="suba">Substanta activa </label>
				<input type="text" id="suba" name="suba" placeholder=" ">
				<br>
				
				<label for="mod_a">Mod de administrare </label>
				<input type="text" id="mod_a" name="mod_a" placeholder=" ">
				<br>
				
				<label for="mod_p">Mod de pastrare </label>
				<input type="text" id="mod_p" name="mod_p" placeholder=" ">
				<br>
				
				<label for="contraindicatii">Contraindicatii </label>
				<input type="text" id="contraindicatii" name="contraindicatii" placeholder=" ">
				<br>
				
				<label for="continut">Continut </label>
				<input type="text" id="continut" name="continut" placeholder=" ">
				<br>
				
				<input type="submit" value="Submit">
				
				
			</form>
			
			
			<?php
		// $codm ,$prod ,$den ,$pret ,$stoc ,$data_exp ,$prescriptie ,$nat_exp ,$nat_suba ,$suba ,$mod_a ,
		// $mod_p ,$contraindicatii ,$continut
		?>
			
			
			
			<?php  
			include_once(dirname(__FILE__) . '/Medicament.php');
			 
			if($_SERVER['REQUEST_METHOD']=='POST')
           {
			\Medicament\addMedicament($_POST['prod'],$_POST['den'],$_POST['pret'],$_POST['stoc'],$_POST['data_exp'],$_POST['prescriptie'],$_POST['nat_exp'],
							$_POST['nat_suba'],$_POST['suba'],$_POST['mod_a'],$_POST['mod_p'],$_POST['contraindicatii'],$_POST['continut']);
		   }
			
			?>
		</div>
</body>
</html>