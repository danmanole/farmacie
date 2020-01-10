<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Services\DBService;

class RaportController extends ResourceController {
    protected $format = 'json';
    static $db;
    
    /**
     * /raportController/stoc
     * @param integer $medicamentId
     */
    public function stoc($medicamentId) {
       $this->init();
       if ($medicamentId == -1) {
           $sql = "SELECT * FROM medicament WHERE stoc > 0 ORDER by den";
       } else {
           $sql = "SELECT * FROM medicament WHERE codm=$medicamentId";
       }
       $query = self::$db->query($sql);
       $rows = $query->getResult();
       return $this->respond($this->createExcelPage($rows));
    }
    
    /**
     * /raportController/vanzare/$idFarmacie
     * Vanzare pentru o singura farmacie (sau toate daca idFarmacie este -1)
     * @param integer $idFarmacie
     * @return mixed|\CodeIgniter\HTTP\Message|\CodeIgniter\HTTP\Response
     */
    public function vanzare($idFarmacie, $deLa=null, $la=null) {
        $this->init();
        $deLaLa = $this->limitaData($deLa, $la);
        if ($idFarmacie == -1) {
            $sql = "SELECT medicament.den, sum(vanzare.cant) as cantitate, cast(avg(vanzare.pret) as decimal(10,2)) as avpret"
                . " FROM vanzare JOIN medicament ON medicament.codm=vanzare.codm "
                . $deLaLa
                . " GROUP BY medicament.den HAVING sum(vanzare.cant) > 0 ORDER BY den";
        } else {
            $sql = "SELECT medicament.den, sum(vanzare.cant) as cantitate, cast(avg(vanzare.pret) as decimal(10,2)) as avpret"
                . " FROM vanzare JOIN medicament ON medicament.codm=vanzare.codm "
                . " WHERE vanzare.codf=$idFarmacie"
                . $deLaLa
                . " GROUP BY medicament.den HAVING sum(vanzare.cant) > 0 ORDER BY den";
        }
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        return $this->respond($this->createVanzarePage($rows));
    }
    
    /**
     * raportController/totalVanzari
     * Vanzari pentru toate farmaciile
     */
    public function totalVanzari($deLa=null, $la=null) {
        $this->init();
        $deLaLa = $this->limitaData($deLa, $la);
        $sql = "SELECT medicament.den, sum(vanzare.cant) as cantitate, cast(avg(vanzare.pret) as decimal(10,2)) as avpret"
            . " FROM vanzare JOIN medicament ON medicament.codm=vanzare.codm "
            . $deLaLa
            . " GROUP BY medicament.den HAVING sum(vanzare.cant) > 0 ORDER BY den";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        return $this->respond($this->createVanzarePage($rows));
    }
    
    /**
     * Creeaza o pagina pentru Excel
     * @param array $rows randuri cu medicamente din baza de date
     * @return NULL[]
     */
    private function createVanzarePage($rows) {
        $vanzari = array();
        $vanzari[] = array("Medicament", "Cantitate", "Pret");
        foreach ($rows as $row) {
            $vanzari[] = $this->getRowVanzare($row);
        }
        return $vanzari;
    }
    
    /**
     * Creeaza o pagina pentru Excel
     * @param array $rows randuri cu medicamente din baza de date
     * @return NULL[]
     */
    private function createExcelPage($rows) {
        $medicamente = array();
        $medicamente[] = array("Medicament", "Stoc");
        foreach ($rows as $row) {
            $medicamente[] = $this->getRowMedicament($row);
        }
        return $medicamente;
    }
    
    /**
     * Pregateste un rand pentru Excel
     * @param object $row
     */
    private function getRowMedicament($row) {
        $col = array();
        $col[] = $row->den;
        $col[] = $row->stoc;
        return $col;
    }
    
    /**
     * Pregateste un rand pentru Excel
     * @param object $row
     */
    private function getRowVanzare($row) {
        $col = array();
        $col[] = $row->den;
        $col[] = $row->cantitate;
        $col[] = $row->avpret;
        return $col;
    }
    
    private function limitaData($deLa, $la) {
        $txtDeLa = '';
        $txtLa = '';
        if ($deLa) {
            $txtDeLa = " AND data_vanz>='$deLa' ";
        } else {
            $txtDeLa = " AND data_vanz>='0000-00-00' ";
        }
        if ($la && $la != '0000-00-00') {
            $txtLa = " AND data_vanz<'$la' ";
        }
        return $txtDeLa . $txtLa;
    }
    
    private function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
}