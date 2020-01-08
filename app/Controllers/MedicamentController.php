<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Services\DBService;
use App\Models\Entity\Medicament;

class MedicamentController extends ResourceController {
    protected $format = 'json';
    static $db;
    
    /**
     * /medicamentController/$term
     * @param string $term
     * @return mixed|\CodeIgniter\HTTP\Message|\CodeIgniter\HTTP\Response
     */
    public function search($term) {
        $this->init();
        $sql = "SELECT * FROM medicament WHERE den LIKE '%$term%'";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $medicamente = array();
        foreach ($rows as $row) {
            $medicamente[] = $this->getMedicament($row);
        }
        return $this->respond($medicamente);
    }
    
    /**
     * /medicamentController/$id
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::show()
     */
    public function show($id = null) {
        $this->init();
        $sql = "SELECT * FROM medicament where codm=$id";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (!empty($rows)) {
            return $this->respond($this->getMedicament($rows[0]));
        }
        return $this->respond([]);
    }
    
    /**
     * /medicamentController/create
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::create()
     */
    public function create() {
        $this->init();
        $data = $this->request->getPost();
        $sql = "INSERT INTO medicament VALUES(null, '$data[prod]', '$data[den]', "
        . " $data[pret], 0, '$data[data_exp]', '$data[prescriptie]', "
        . " '$data[nat_exp]', '$data[nat_suba]', '$[suba]', '$[mod_a]', '$[mod_p]'"
        . " '$data[contraindicatii]', '$data[continut]')";
        self::$db->query($sql);
        $id = self::$db->insertID();
        return $this->respondCreated($id);
    }
    
    /**
     * /medicamentController/update/$id
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::update()
     */
    public function update($id = null) {
        $this->init();
        $data = $this->request->getPost();
        $sql = "UPDATE medicament SET prod='$data[prod]', den='$data[den]', "
        . "pret=$data[pret], data_exp='$data[data_exp]', prescriptie='$data[prescriptie]',"
        . "nat_exp='$data[nat_exp]', nat_suba='$data[nat_suba]', suba='$data[suba]',"
        . "mod_a='$data[mod_a]', mod_p='$data[mod_p]', contraindicatii='$data[contraindicatii]',"
        . "continut='$data[continut]' WHERE codm=$id";
        self::$db->query($sql);
        return $this->respond($id);
    }
    
    /**
     * /medicamentController/achizitie/$codm
     * @param integer $codm
     */
    public function achizitie($codm) {
        $this->init();
        $data = $this->request->getPost();
        $sql = "UPDATE medicament SET pret=pret + $data[pret], stoc=stoc + $data[cant] WHERE codm=$codm";
        self::$db->query($sql);
        return $codm;
    }
    
    private function getMedicament($row) {
        return Medicament::newMedicament($row->codm, $row->prod, $row->den, $row->pret, $row->stoc, $row->data_exp,
            $row->prescriptie, $row->nat_exp, $row->nat_suba, $row->suba, $row->mod_a, $row->mod_p, 
            $row->contraindicatii, $row->continut);
    }
    
    private function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
}