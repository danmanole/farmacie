<?php
namespace functions;

use PDO;
use PDOException;

function OpenCon()
{
	//mysql user, database, password and host
    $user = 'root';
    $pass = '';
    $db = 'farmacie';
    $servername = 'localhost';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $user, $pass);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // //echo "Connected successfully";
    } catch (PDOException $e) {
        // //echo "Connection failed: " . $e->getMessage();
    }

    return $conn;
}

function CloseCon($conn)
{
    $conn = null;
    // echo "<br>Connection closed!";
}

function getNextID($tabel, $cod)
{
    $conn = OpenCon();

    try {
        $stmt = $conn->prepare("select max($cod) from $tabel");
        $stmt->execute([
            'cod' => $cod
        ]);
        $stmt->execute([
            'tabel' => $tabel
        ]);
        $res = $stmt->fetchColumn(0);
        // echo "<br>";
        // echo $res;

        if ($res == 0)
            $ret = 1;
        else if ($res > 0)
            $ret = $res + 1;
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    CloseCon($conn);

    return $ret;
}

function deleteFrom($cod, $tabel, $cecod)
{
    $conn = OpenCon();

    try {

        $sql = "delete from $tabel where $cecod=$cod";
        $stmt = $conn->prepare($sql)->execute();
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    CloseCon($conn);
}

function checkLogin($id, $pass)
{
    $conn = OpenCon();

    try {

        $sql = "select password from users where user='" . $id . "'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchColumn(0);
        // echo "<br>";
        // echo $res;

        if ($res == $pass) {
            CloseCon($conn);
            return 1;
        } else {
            CloseCon($conn);
            return 0;
        }
    } catch (PDOException $e) {
        // //echo $sql . "<br>" . $e->getMessage();
    }

    CloseCon($conn);
}


  ?>