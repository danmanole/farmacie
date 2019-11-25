<?php
namespace Client;
include_once(dirname(__FILE__) . '/../functions.php');

use PDO;
use PDOException;

/**
 * Adaugare client
 *
 * @param string $nume
 * @param string $prenume
 * @param string $sex
 * @param int $varsta
 */
function addClient($nume, $prenume, $sex, $varsta)
{
    $conn = \functions\OpenCon();

    try {
        $codc = \functions\getNextID("client", "codc");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO client (codc ,nume ,prenume, sex, varsta) VALUES
			('$codc','$nume','$prenume','$sex','$varsta')";
        $conn->exec($sql);
        // echo "New record created successfully";
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}

/**
 * Modificare client
 *
 * @param int $codc
 * @param string $nume
 * @param string $prenume
 * @param string $sex
 * @param int $varsta
 */
function updateClient($codc, $nume, $prenume, $sex, $varsta)
{
    $conn = \functions\OpenCon();

    try {
        $sql = "update client set nume=? , prenume=? , sex=?, varsta=?  where codc=?";
        $stmt = $conn->prepare($sql)->execute([
            $nume,
            $prenume,
            $sex,
            $varsta,
            $codc
        ]);
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }
    \functions\CloseCon($conn);
}

/**
 * Obtine nume/prenume client`
 *
 * @param int $codc
 *            cod client
 * @return string "Nume Prenume"
 */
function getNumePrenumeClient($codc)
{
    $conn = \functions\OpenCon();

    try {
        $sql = "select nume,prenume from client where codc=$codc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();

        $nume = $row[0];
        $prenume = $row[1];
        $fullname = $nume . ' ' . $prenume;
        \functions\CloseCon($conn);
        return $fullname;
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }
    \functions\CloseCon($conn);
}

/**
 * Detalii client
 *
 * @param int $codc
 *            cod client
 * @return mixed[]
 */
function getClientDet($codc)
{
    $conn = \functions\OpenCon();

    try {
        $sql = "select nume,prenume,sex,varsta from client where codc=$codc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();

        $nume = $row[0];
        $prenume = $row[1];
        $sex = $row[2];
        $varsta = $row[3];

        $v = array(
            $nume,
            $prenume,
            $sex,
            $varsta
        );
        \functions\CloseCon($conn);
        return $v;
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}

/**
 * Selectie clienti
 */
function coduriSelectClienti()
{
    $conn = \functions\OpenCon();

    try {
        $sql = "select codc from client";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        echo "<label for='codc'>Client</label>
				<select id='codc' name='codc'>";

        if ($stmt->rowCount())
            while ($row = $stmt->fetch()) {
                $codc = $row['codc'];
                $fullname = getNumePrenumeClient($codc);
                echo "<option value='" . $row['codc'] . "'>" . $fullname . "</option>";
            }
        echo "</select><br>";
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}

/**
 * Tabela lista clienti
 */
function printClientList()
{
    $conn = \functions\OpenCon();

    try {

        // $codm ,$prod ,$den ,$pret ,$stoc ,$data_exp ,$prescriptie ,
        // $nat_exp ,$nat_suba ,$suba ,$mod_a ,
        // $mod_p ,$contraindicatii ,$continut

        echo "
			<form method='post' name='form1' >
			<table>
			<tr>
			<th>ID</th>
			<th>Nume</th>
			<th>Prenume</th>
			<th>Sex</th>
			<th>Varsta</th>
			</tr>";

        $sql = "select codc,nume,prenume,sex,varsta from client";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {
                echo "<input type='hidden' name='codm' value=" . $row['codc'] . ">";
                echo "<input type='hidden' name='den' value=" . $row['nume'] . ">";
                echo "<input type='hidden' name='pret' value=" . $row['prenume'] . ">";
                echo "<input type='hidden' name='stoc' value=" . $row['sex'] . ">";
                echo "<input type='hidden' name='suba' value=" . $row['varsta'] . ">";

                echo "<tr>" . "<td>" . $row['codc'] . "</td>" . "<td>" . $row['nume'] . "</td>" . "<td>" . $row['prenume'] . "</td>" . "<td>" . $row['sex'] . "</td>" . "<td>" . $row['varsta'] . "</td>" . "<td><a href='editClient.php?codc=" . $row['codc'] . "' >Edit</a></td>" . "<td><a href='deleteClient.php?codc=" . $row['codc'] . "' >Delete</a></td>" . "</tr></form>";
            }
        } else {
            // echo "0 records selected";
        }
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}
