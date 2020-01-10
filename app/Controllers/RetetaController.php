<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Services\DBService;
use App\Models\Entity\Reteta;
use App\Models\Entity\RetetaClient;

class RetetaController extends ResourceController {
    protected $format = 'json';
    static $db;
    
    /**
     * /retetaController/search/$term
     * @param string $term
     * @return mixed|\CodeIgniter\HTTP\Message|\CodeIgniter\HTTP\Response
     */
    public function search($term) {
        $this->init();
        $sql = "SELECT DISTINCT doctor FROM reteta WHERE doctor LIKE '%$term%' ORDER by doctor";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $doctori = array();
        foreach ($rows as $row) {
            $doctori[] = $this->getDoctor($row);
        }
        return $this->respond($doctori);
    }
    
    /**
     * /retetaController/find
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::show()
     */
    public function find() {
        $this->init();
        $data = $this->request->getPost();
        $sql = "SELECT * FROM reteta where codc=$data[codc] AND doctor='$data[doctor]' ORDER BY data_elib DESC";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $retete = array();
        foreach ($rows as $row) {
            $retete[] = $this->getReteta($row);
        }
        return $this->respond($retete);
    }
    
    /**
     * /retetaController/create
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::create()
     */
    public function create() {
        $this->init();
        $data = $this->request->getPost();
        $sql = "SELECT codc FROM client WHERE nume='$data[nume]' AND prenume='$data[prenume]' "
            . "AND sex='$data[sex]' AND varsta=$data[varsta]";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $codr = -1;
        
        if (!empty($rows)) {
            $clientId = $rows[0]->codc;
            // verifica daca exista aceasta reteta (din trecut)
            $sql = "SELECT codr FROM reteta WHERE doctor='$data[doctor]' AND codc=$clientId "
                ." AND tip='$data[tip]' AND data_elib='$data[data_elib]' AND diag='$data[diag]'";
            $query = self::$db->query($sql);
            $rows = $query->getResult();
            if (!empty($rows)) {
                $codr = $rows[0]->codr;
            }
        } else {//client nou
            $sql = "INSERT INTO client VALUES(null, '$data[nume]', '$data[prenume]', "
                . " $data[sex], '$data[varsta])";
            self::$db->query($sql);
            $clientId = self::$db->insertID();
        }
        
        if ($codr == -1) {
            $sql = "INSERT INTO reteta VALUES(null, '$data[doctor]', '$data[diag]',"
                . "'$data[tip]', '$data[data_elib]', $clientId)";
            self::$db->query($sql);
            $codr = self::$db->insertID();
        }
        return $this->respondCreated($codr);
    }
    
    /**
     * /retetaController/complete/$idReteta
     * @param integer $idReteta
     */
    public function complete($idReteta) {
        $this->init();
        $sql = "SELECT client.codc, nume, prenume, doctor, codr, data_elib, tip FROM reteta "
            . " LEFT JOIN client ON reteta.codc=client.codc WHERE codr=$idReteta";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (!empty($rows)){
            return $this->respond($this->getRetetaClient($rows[0]));
        }
        return $this->respond();
    }
    
    private function getDoctor($row) {
        return $row->doctor;
    }
    
    private function getReteta($row) {
        return Reteta::newReteta($row->codr, $row->doctor, $row->diag, $row->tip, $row->data_elib,
            $row->codc);
    }
    
    private function getRetetaClient($row) {
        return RetetaClient::newRetetaClient($row->codc, $row->nume, $row->prenume, 
            $row->doctor, $row->codr, $row->data_elib, $row->tip);
    }
    
    private function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
}