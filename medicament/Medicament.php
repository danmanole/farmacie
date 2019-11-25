<?php
namespace Medicament;
include_once(dirname(__FILE__) . '/../functions.php');

use \PDO;
use \PDOException;

function addMedicament($prod, $den, $pret, $stoc, $data_exp, $prescriptie, $nat_exp, $nat_suba, $suba, $mod_a, $mod_p, $contraindicatii, $continut)
{
    $conn = \functions\OpenCon();
    $codm = \functions\getNextID("medicament", "codm");
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into medicament (codm ,prod ,den ,pret ,stoc ,data_exp ,prescriptie ,nat_exp ,nat_suba ,suba ,mod_a ,mod_p ,contraindicatii ,continut) values
			('$codm' ,'$prod' ,'$den' ,'$pret' ,'$stoc' ,'$data_exp' ,'$prescriptie' ,'$nat_exp' ,'$nat_suba' ,'$suba' ,'$mod_a' ,'$mod_p' ,'$contraindicatii' ,'$continut')";
        $conn->exec($sql);
        // echo "New record created successfully";
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}

function updateMed($codm, $den, $pret, $stoc, $suba, $continut, $contraindicatii, $prod, $data_exp, $prescriptie, $nat_exp, $nat_suba, $mod_a, $mod_p)
{
    $conn = \functions\OpenCon();

    try {
        $sql = "update medicament set den=? , pret=? , stoc=?, suba=? , continut=?, contraindicatii=?, prod=?,
			data_exp=?, prescriptie=? , nat_exp=?, nat_suba=?, mod_a=?, mod_p=? where codm=?";

        $stmt = $conn->prepare($sql)->execute([
            $den,
            floatval($pret),
            intval($stoc),
            $suba,
            $continut,
            $contraindicatii,
            $prod,
            $data_exp,
            $prescriptie,
            $nat_exp,
            $nat_suba,
            $mod_a,
            $mod_p,
            $codm
        ]);

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}

/**
 * Intoarce denumire medicament
 *
 * @param int $codm
 * @return string
 */
function getMedDen($codm)
{
    $conn = \functions\OpenCon();
    $nume = '';
    try {

        $sql = "select den from medicament where codm=$codm";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();

        $nume = $row[0];
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    } finally {
        \functions\CloseCon($conn);
    }

    return $nume;
}

/**
 * Detalii medicament
 * @param int $codm medicament
 */
// codm ,prod ,data_exp ,prescriptie ,nat_exp ,nat_suba ,mod_a ,mod_p ,
function getMedDet($codm)
{
    $conn = \functions\OpenCon();

    try {
        $sql = "select den,pret,stoc,suba,continut,contraindicatii,prod,data_exp,prescriptie,nat_exp,nat_suba,mod_a,mod_p from medicament where codm=$codm";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();

        $den = $row[0];
        $pret = $row[1];
        $stoc = $row[2];
        $suba = $row[3];
        $continut = $row[4];
        $contraindicatii = $row[5];
        $prod = $row[6];
        $data_exp = $row[7];
        $prescriptie = $row[8];
        $nat_exp = $row[9];
        $nat_suba = $row[10];
        $mod_a = $row[11];
        $mod_p = $row[12];

        $v = array(
            $den,
            $pret,
            $stoc,
            $suba,
            $continut,
            $contraindicatii,
            $prod,
            $data_exp,
            $prescriptie,
            $nat_exp,
            $nat_suba,
            $mod_a,
            $mod_p
        );
        \functions\CloseCon($conn);
        return $v;
    } catch (PDOException $e) {
        // //echo $sql . "<br>" . $e->getMessage();
    }
    \functions\CloseCon($conn);
}

/**
 * Tabela medicamente
 */
function printMedList()
{
    $conn = \functions\OpenCon();

    try {

        // $codm ,$prod ,$den ,$pret ,$stoc ,$data_exp ,$prescriptie ,
        // $nat_exp ,$nat_suba ,$suba ,$mod_a ,
        // $mod_p ,$contraindicatii ,$continut
        echo "
			<form method='post' name='form1'  >
			<table>
			<tr>
			<th>ID</th>
			<th>Denumire</th>
			<th>Pret</th>
			<th>Stoc</th>
			<th>Substanta activa</th>
			<th>Continut</th>
			<th>Contraindicatii</th>
			</tr>";

        $sql = "select codm,den,pret,stoc,suba,continut,contraindicatii from medicament";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($stmt->rowCount()) {

            while ($row = $stmt->fetch()) {

                echo "<input type='hidden' name='codm' value=" . $row['codm'] . ">";
                echo "<input type='hidden' name='den' value=" . $row['den'] . ">";
                echo "<input type='hidden' name='pret' value=" . $row['pret'] . ">";
                echo "<input type='hidden' name='stoc' value=" . $row['stoc'] . ">";
                echo "<input type='hidden' name='suba' value=" . $row['suba'] . ">";
                echo "<input type='hidden' name='continut' value=" . $row['continut'] . ">";
                echo "<input type='hidden' name='contraindicatii' value=" . $row['contraindicatii'] . ">";

                echo "<tr>" . "<td>" . $row['codm'] . "</td>" . "<td>" . $row['den'] . "</td>" . "<td>" . $row['pret'] . "</td>" . "<td>" . $row['stoc'] . "</td>" . "<td>" . $row['suba'] . "</td>" . "<td>" . $row['continut'] . "</td>" . "<td>" . $row['contraindicatii'] . "</td>" . "<td><a href='editMed.php?codm=" . $row['codm'] . "' >Edit</a></td>" . "<td><a href='delete.php?codm=" . $row['codm'] . "' >Delete</a></td>" . "</tr></form>";
            }
        } else {
            // echo "0 records selected";
        }
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}

/**
 * Tabela medicamente
 */
function printMedFullList()
{
    $conn = \functions\OpenCon();

    try {

        // $codm ,$prod ,$den ,$pret ,$stoc ,$data_exp ,$prescriptie ,
        // $nat_exp ,$nat_suba ,$suba ,$mod_a ,
        // $mod_p ,$contraindicatii ,$continut

        echo "
			<form method='post' name='form1'  >
			<table>
			<tr>
			<th>ID</th>
			<th>Denumire</th>
			<th>Pret</th>
			<th>Stoc</th>
			<th>Substanta activa</th>
			<th>Continut</th>
			<th>Contraindicatii</th>
			<th>Producator</th>
			<th>Data expirare</th>
			<th>Prescriptie</th>
			<th>Natura excipient</th>
			<th>Natura substanta activa</th>
			<th>Mod administrare</th>
			<th>Mod pastrare</th>
			</tr>";

        $sql = "select codm,den,pret,stoc,suba,continut,contraindicatii,prod,data_exp,prescriptie,nat_exp,nat_suba,mod_a,mod_p from medicament";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {

                echo "<input type='hidden' name='codm' value=" . $row['codm'] . ">";
                echo "<input type='hidden' name='den' value=" . $row['den'] . ">";
                echo "<input type='hidden' name='pret' value=" . $row['pret'] . ">";
                echo "<input type='hidden' name='stoc' value=" . $row['stoc'] . ">";
                echo "<input type='hidden' name='suba' value=" . $row['suba'] . ">";
                echo "<input type='hidden' name='continut' value=" . $row['continut'] . ">";
                echo "<input type='hidden' name='contraindicatii' value=" . $row['contraindicatii'] . ">";
                echo "<input type='hidden' name='prod' value=" . $row['prod'] . ">";
                echo "<input type='hidden' name='data_exp' value=" . $row['data_exp'] . ">";
                echo "<input type='hidden' name='prescriptie' value=" . $row['prescriptie'] . ">";
                echo "<input type='hidden' name='nat_exp' value=" . $row['nat_exp'] . ">";
                echo "<input type='hidden' name='nat_suba' value=" . $row['nat_suba'] . ">";
                echo "<input type='hidden' name='mod_a' value=" . $row['mod_a'] . ">";
                echo "<input type='hidden' name='mod_p' value=" . $row['mod_p'] . ">";

                echo "<tr>" . "<td>" . $row['codm'] . "</td>" . "<td>" . $row['den'] . "</td>" . "<td>" . $row['pret'] . "</td>" . "<td>" . $row['stoc'] . "</td>" . "<td>" . $row['suba'] . "</td>" . "<td>" . $row['continut'] . "</td>" . "<td>" . $row['contraindicatii'] . "</td>" . "<td>" . $row['prod'] . "</td>" . "<td>" . $row['data_exp'] . "</td>" . "<td>" . $row['prescriptie'] . "</td>" . "<td>" . $row['nat_exp'] . "</td>" . "<td>" . $row['nat_suba'] . "</td>" . "<td>" . $row['mod_a'] . "</td>" . "<td>" . $row['mod_p'] . "</td>" . "</tr></form>";
            }
        } else {
            // echo "0 records selected";
        }
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}

/**
 * Selectie coduri medicament
 */
function coduriSelectMedicament()
{
    $conn = \functions\OpenCon();

    try {
        $sql = "select codm from medicament";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        echo "<label for='codm'>Medicament</label>
				<select id='codm' name='codm'>";

        if ($stmt->rowCount())
            while ($row = $stmt->fetch()) {
                $codm = $row['codm'];
                $den = getMedDen($codm);
                echo "<option value='" . $row['codm'] . "'>" . $den . "</option>";
            }
        echo "</select><br>";
    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
    }

    \functions\CloseCon($conn);
}