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
		<li><a href="../client/addClient.php">Adauga client</a></li>
		<li><a href="../reteta/addReteta.php">Adauga reteta</a></li>
		<li><a href="../gestiune/addVanzare.php">Adauga vanzare</a></li>
		<li><a href="addMedicament.php">Adauga medicament</a></li>
		<li><a class="active" href="editMed.php">Lista medicamente</a></li>
		<li><a  href="../client/listaClienti.php">Lista clienti</a></li>
		<li style="float:right"><a class="active" href="../contact.php">Contact</a></li>
		</ul>
	</div>
</div>
		<?php
		
		include(dirname(__FILE__) . '/Medicament.php');
	
		$codm = $_GET['codm'];
		$v=\Medicament\getMedDet($codm);
		
			$den =$v[0];
			$pret =$v[1];
			$stoc =$v[2];
			$suba =$v[3];
			$continut =$v[4];
			$contraindicatii=$v[5];
			$prod =$v[6];
			$data_exp =$v[7];
			$prescriptie =$v[8];
			$nat_exp =$v[9];
			$nat_suba =$v[10];
			$mod_a =$v[11];
			$mod_p =$v[12];
		?>

		<div>
		<br><br><br><br><br><br>
			<form method="post" id="my_form" >
				<legend>Editeaza medicament</legend>
				
				<label for="codm">Cod medicament </label>
				<input type="text" id="codm" name="codm" placeholder=" " value="<?php echo $codm ?> " readonly>
				<br>
				
				<label for="prod">Producator </label>
				<input type="text" id="prod" name="prod" placeholder=" " value="<?php echo $prod ?> ">
				<br>
				
				<label for="den">Denumire </label>
				<input type="text" id="den"  name="den" placeholder=" " value="<?php echo $den ?> ">
				<br>
				
				<label for="pret">Pret</label>
				<input type="text" id="pret"  name="pret" onkeypress="isInputNumber(event)" value="<?php echo $pret ?> ">
				<br>
				
				<label for="stoc">Stoc</label>
				<input type="text" id="stoc"  name="stoc" onkeypress="isInputNumber(event)" value="<?php echo $stoc ?> ">
				<br>
				
				<label for="data_exp">Data expirare</label>
				<input  id="data_exp" name="data_exp" value="<?php echo $data_exp ?> " type="date" >
				<br>
				
				<label for="prescriptie">Prescriptie </label>
				<input type="text" id="prescriptie" name="prescriptie" placeholder=" " value="<?php echo $prescriptie ?> ">
				<br>
				
				<label for="nat_exp">Natura excipient </label>
				<input type="text" id="nat_exp" name="nat_exp" placeholder=" " value="<?php echo $nat_exp ?> ">
				<br>
				
				<label for="nat_suba">Natura substanta activa </label>
				<input type="text" id="nat_suba" name="nat_suba" placeholder=" " value="<?php echo $nat_suba ?> ">
				<br>
				
				<label for="suba">Substanta activa </label>
				<input type="text" id="suba" name="suba" placeholder=" " value="<?php echo $suba ?> ">
				<br>
				
				<label for="mod_a">Mod de administrare </label>
				<input type="text" id="mod_a" name="mod_a" placeholder=" " value="<?php echo $mod_a ?> ">
				<br>
				
				<label for="mod_p">Mod de pastrare </label>
				<input type="text" id="mod_p" name="mod_p" placeholder=" " value="<?php echo $mod_p ?> ">
				<br>
				
				<label for="contraindicatii">Contraindicatii </label>
				<input type="text" id="contraindicatii" name="contraindicatii" placeholder=" " value="<?php echo $contraindicatii ?> ">
				<br>
				
				<label for="continut">Continut </label>
				<input type="text" id="continut" name="continut" placeholder=" " value="<?php echo $continut ?> ">
				<br>
				
				<input type="submit" value="Submit">
				
					 
			</form>
			
			
			<?php
			
           if($_SERVER['REQUEST_METHOD']=='POST')
           {

            $contraindicatii="dadada";
			$codm=$_POST['codm'];
			$den =$_POST['den'];
			$pret =$_POST['pret'];
			$stoc =$_POST['stoc'];
			$suba =$_POST['suba'];
			$continut =$_POST['continut'];
			$contraindicatii=$_POST['contraindicatii'];
			$prod=$_POST['prod'];
			$data_exp=$_POST['data_exp'];
			$prescriptie=$_POST['prescriptie'];
			$nat_exp=$_POST['nat_exp'];
			$nat_suba=$_POST['nat_suba'];
			$mod_a=$_POST['mod_a'];
			$mod_p=$_POST['mod_p'];
			
			
			\Medicament\updateMed($codm,$den , $pret , $stoc , $suba , $continut , $contraindicatii,$prod,$data_exp,$prescriptie,$nat_exp,$nat_suba,$mod_a,$mod_p);
			header("Location:listaMed.php");
			
		   }
			?>
		
		</div>
</body>
</html>