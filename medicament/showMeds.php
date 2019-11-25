<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="stylesheet" type="text/css" href="../pageStyle.css">

<script type="text/javascript" src="../script.js"></script>
</head> 
<body>
<div class="container">

    <?php
    include_once(dirname(__FILE__) . '/Medicament.php');
	\Medicament\printMedList();
    ?>

</div>
</body>
</html>
