<!DOCTYPE html>
<html>
<head>
<?php 
$path = '/farmacie/public/'  ;
?>
<link rel="stylesheet" href="<?php echo $path;?>css/style.css">
<link rel="stylesheet" href="<?php echo $path;?>css/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo $path;?>css/pageStyle.css">
<link rel="icon" href="<?php echo $path;?>/favicon.ico" type="image/ico">


<script type="text/javascript" src="<?php echo $path;?>js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo $path;?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $path;?>js/script.js"></script>


<?php 
if (isset($script)) {
    echo "<script type=\"text/javascript\" src=\"$path/js/$script\"></script>";
}
?>
</head>
<body>
<div class="container">

<div class="logo"><img src="<?php echo $path;?>/img/megafarm - 60p.png"></div>
<?php 
echo $bara;
?>

<br><br>

<!--  <div id="content" style="text-align: center; width:100%">-->
<?php 
if (isset($content)) {
    include dirname(__FILE__) . "/content/$content";
}
?>
<!--  </div>-->
<?php
//include dirname(__FILE__) . '/./gestiune/Gestiune.php';
//\Gestiune\printVanzare();
?>

</div>
<script type="text/javascript">
<?php 

// get the current user job to set the menus
if (isset($job)) {
    echo "var currentUserJob='$job';";
} else {
    echo "var currentUserJob='Farmacist';";
}
?>

</script>
</body>
</html>