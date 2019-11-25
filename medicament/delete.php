
<?php
		
include_once(dirname(__FILE__) . '/../functions.php');
		
		$codm = $_GET['codm'];
		$tabel="medicament";
		$cecod="codm";
		\functions\deleteFrom($codm,$tabel,$cecod);
		header("Location:listaMed.php");
		
		
		
?>
	