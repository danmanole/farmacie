<div>
one &nbsp;&nbsp;&nbsp;&nbsp;           two<br/>
trei

<ol>
<?php 
$tmp = '';
for ($i = 1; $i < 11; $i++) {
    $tmp .= "<li>Client $i</li>";// $tmp = $tmp +   "<li>$i</li>"
}
echo $tmp;
?>
</ol>

<?php 
$tbl = array(
    array('numePers' => 'Vasile', 'cantitate' => 2),
    array('numePers' => 'Ion', 'cantitate' => 101),
    array('numePers' => 'Petrica', 'cantitate' => 20),
    array('numePers' => 'Vasilica', 'cantitate' => 4)
);
?>

<table id="coco">
	<tr>
		<th>Nume</th><th>Cantitate</th>
	</tr>

<?php 

foreach ($tbl as $rand) {
    
    $nume = $rand['numePers'];
    $cant = $rand['cantitate'];
    /*
    $tmp = '<tr>';  
    $tmp .= '<td>'. $nume . '</td><td>' . $cant . '</td>';
    $tmp .= '</tr>';
    */
    /*$tmp = "<tr><td>$nume</td><td>$cant</td></tr>";*/
    $tmp = "<tr><td>$rand[numePers]</td><td>$rand[cantitate]</td></tr>";
    echo $tmp;
}

?>
</table>

<?php 

$a = 10;
$b = 3;
echo "$a$b<br>";
echo "$ab<br>";// nu functioneaza pentru ca php se ganeste ca ai nevoie de $ab
echo "{$a}b";// trebuie sa separ variabila $a de litera b, ele sunt "interpretate"

?>
<p></p>
<input type="button" onclick="toto()" value="aaa"/>

<div id="din"></div>
<table id="a101">


</table>
<script type="text/javascript">

function toto() {

	$('#din').html('aaa');
}

</script>
</div>