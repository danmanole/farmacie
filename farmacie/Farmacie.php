<?php
namespace Farmacie;

include_once(dirname(__FILE__) . '/../functions.php');
include_once(dirname(__FILE__) . '/../common/Sequel.php');

use \PDO;
use \common\Sequel;

class Farmacie
{

    public function addFarmacie($filiala, $activa)
    { 
        $sql = "INSERT INTO farmacie values(null, '$filiala', $activa)";
        Sequel::executeQuery($sql);
    }

    public function editFarmacie($codf, $filiala, $activa)
    {
        $sql = "UPDATE farmacie set filiala='$filiala', activa=$activa WHERE codf=$codf";
        Sequel::executeQuery($sql);
    }

    public function getFarmacie($codf)
    {
        $conn = \functions\OpenCon();
        $sql = "SELECT * from farmacie where codf=$codf LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        if($stmt->rowCount()) {
            $row = $stmt->fetch();
            return array($row['codf'], $row['filiala'], $row['activa']);
        }
        \functions\CloseCon($conn);
    }

    public function deleteFarmacie($codf)
    {
        $sql = "UPDATE farmacie set activa=false where codf=$codf LIMIT 1";
        Sequel::executeQuery($sql);
    }
    
    
}