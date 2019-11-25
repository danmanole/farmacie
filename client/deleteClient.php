
<?php
		
include_once(dirname(__FILE__) . '/../functions.php');
		
		$codc = $_GET['codc'];
		$tabel="client";
		$cecod="codc";
		\functions\deleteFrom($codc,$tabel,$cecod);
		header("Location:listaClienti.php");
		
		
		
?>
	