<?php
namespace Gestiune;
include_once(dirname(__FILE__) . '/../functions.php');
include_once(dirname(__FILE__) . '/../medicament/Medicament.php');

use \PDO;
use \PDOException;


function printVanzare(){
    
    $conn=\functions\OpenCon();
    
    try {
        
        echo "
			<form method='post' name='form4' >
			<table>
			<tr>
			<th>ID</th>
			<th>Medicament</th>
			<th>Cantitate</th>
			<th>Data vanzare</th>
			<th>Total plata</th>
			</tr>";
        
        
        $sql= "select vanzare.codv, vanzare.codm, vanzare.cant, bon.datav, bon.total_plata from vanzare, bon  where vanzare.codv= bon.codv";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        if($stmt->rowCount()) {
            
            while($row = $stmt->fetch()){
                /*
                 echo"<input type='hidden' name='codm' value=". $row['codc'] .">";
                 echo"<input type='hidden' name='den' value=". $row['nume'] .">";
                 echo"<input type='hidden' name='pret' value=". $row['prenume'] .">";
                 echo"<input type='hidden' name='stoc' value=". $row['sex'] .">";
                 echo"<input type='hidden' name='suba' value=". $row['varsta'] .">";
                 */
                
                $codm=$row['codm'];
                $den=\Medicament\getMedDen($codm);
                
                echo "<tr>" .
                    "<td>". $row['codv'] . "</td>" .
                    "<td>". $den . "</td>" .
                    "<td>". $row['cant'] . "</td>" .
                    "<td>". $row['datav'] . "</td>" .
                    "<td>". $row['total_plata'] . "</td>" .
                    "</tr></form>" ;
                
            }
        }
        else{
            //echo "0 records selected";
        }
    }
    catch(PDOException $e)
    {
        //echo $sql . "<br>" . $e->getMessage();
    }
    
    \functions\CloseCon($conn);
}

function addVanzare($cant ,$codm ,$codr ,$datav){
    
    $conn=\functions\OpenCon();
    
    try {
        $codv=\functions\getNextID("vanzare","codv");
        $codb=\functions\getNextID("bon","codb");
        //pretul medicamentului
        $stmt = $conn->prepare("select pret from medicament where codm=:codm");
        $stmt->execute(['codm' => $codm]);
        $pret = $stmt->fetchColumn();
        //echo "<br>";
        //echo  $pret;
        
        //cautam cat la suta este redus daca este cu reteta
        $coef=1;
        
        if($codr != 0){
            $stmt = $conn->prepare("select tip from reteta where codr=:codr");
            $stmt->execute(['codr' => $codr]);
            $tip =$stmt->fetchColumn(0);
            //echo "<br>";
            //echo  $tip;
            $coef=1;
            if("Necompensata"==$tip)
                $coef=1;
                if("Compensata(30%)"==$tip)
                    $coef=0.3;
                    if("Compensata(70%)"==$tip)
                        $coef=0.7;
        }
        
        $total_plata=$pret*$coef*$cant;
        //echo "<br>";
        //echo  $cant;
        
        //adaugare vanzare
        $sql ="insert into vanzare(codv,cant,codm,codr)
                   values ('$codv','$cant','$codm','$codr');";
        $conn->exec($sql);
        //echo "<br>New record created successfully";
        
        //adaugare bon
        
        $sql="insert into bon(codb,total_plata,datav,codv)
                    values ('$codb' , '$total_plata' , '$datav' , '$codv');";
        $conn->exec($sql);
        //echo "<br>New record created successfully";
        
    }
    catch(PDOException $e)
    {
        //echo $sql . "<br>" . $e->getMessage();
    }
    
    \functions\CloseCon($conn);
}
