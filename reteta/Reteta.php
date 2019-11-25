<?php
namespace Reteta;
include_once(dirname(__FILE__) . '/../functions.php');

use \PDO;
use \PDOException;

/**
 * Adaugare reteta
 * 
 */
function addReteta($doctor ,$diag ,$tip ,$data_elib ,$codc){
    
    $conn=\functions\OpenCon();
    
    try {
        $codr=\functions\getNextID("reteta","codr");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into reteta (codr ,doctor ,diag , tip, data_elib,codc) values
			('$codr' ,'$doctor' ,'$diag' ,'$tip' ,'$data_elib' ,'$codc')";
        $conn->exec($sql);
        //echo "New record created successfully";
    }
    catch(PDOException $e)
    {
        //echo $sql . "<br>" . $e->getMessage();
    }
    
    \functions\CloseCon($conn);
}

/**
 * Selectie coduri reteta
 */
function coduriSelectReteta(){
    
    $conn=\functions\OpenCon();
    
    try {
        $sql= "select codr from reteta";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        echo "<label for='codr'>Reteta</label>
				<select id='codr' name='codr'>";
        
        if($stmt->rowCount())
            while($row = $stmt->fetch()){
                echo "<option value='" . $row['codr'] . "'>" . $row['codr']  . "</option>";
        }
        echo "</select><br>";
    }
    catch(PDOException $e)
    {
        //echo $sql . "<br>" . $e->getMessage();
    }
    
    \functions\CloseCon($conn);
}
