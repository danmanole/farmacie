<?php
namespace common;
include_once(dirname(__FILE__) . '/../functions');

use \PDOException;

class Sequel
{
    
    public static function executeQuery($sql)
    {
        $conn = \functions\OpenCon();
        try {
            $conn->exec($sql);
        } catch (PDOException $ex) {
            echo $sql . "<br>" . $ex->getMessage();
        }
        \functions\CloseCon($conn);
    }
}

