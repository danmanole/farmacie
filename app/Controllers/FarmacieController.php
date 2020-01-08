<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Services\DBService;
use App\Models\Entity\Farmacie;

class FarmacieController extends ResourceController {
    protected $format = 'json';
    static $db;
    
    /**
     * /farmacieController/
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::index()
     */
    public function index() {
        $this->init();
        $sql = "SELECT * FROM farmacie ORDER BY filiala";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $farmacii = array();
        foreach ($rows as $row) {
            $farmacii[] = $this->getFarmacie($row);
        }
        return $this->respond($farmacii);
    }
    
    /**
     * /farmacieController/search/$term
     * @param string $term
     * @return mixed|\CodeIgniter\HTTP\Message|\CodeIgniter\HTTP\Response
     */
    public function search($term) {
        $this->init();
        $sql = "SELECT * FROM farmacie WHERE filiala LIKE '%$term%'";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $farmacii = array();
        foreach ($rows as $row) {
            $farmacii[] = $this->getFarmacie($row);
        }
        return $this->respond($farmacii);
    }
    
    /**
     * /farmacieController/show/$id
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::show()
     */
    public function show($id = null) {
        $this->init();
        $sql = "SELECT * FROM farmacie where codf=$id";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (!empty($rows)) {
            return $this->respond($this->getFarmacie($rows[0]));
        }
        return $this->respond([]);
    }
    
    /**
     * /farmacieController/create
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::create()
     */
    public function create() {
        $this->init();
        $data = $this->request->getPost();
        $sql = "INSERT INTO farmacie VALUES(null, '$data[filiala]', true)";
        self::$db->query($sql);
        $id = self::$db->insertID();
        return $this->respondCreated($id);
    }
    
    /**
     * /farmacieController/update
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::update()
     */
    public function update($id = null) {
        $this->init();
        $data = $this->request->getPost();
        $sql = "UPDATE farmacie SET filiala='$data[filiala]', activa=$data[activa] WHERE codf=$id";
        self::$db->query($sql);
        return $this->respond($id);
    }
    
    /**
     * /farmacieController/delete
     * Sterge farmacie daca nu are utilizatori, o face inactiva daca are utilizatori
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::delete()
     */
    public function delete($id = null) {
        $this->init();
        $sql = "SELECT 1 FROM users_farmacie WHERE codf=$id";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (!empty($rows)) {
            $sql = "UPDATE farmacie SET activa=0 WHERE codf=$id";
        } else {
            $sql = "DELETE FROM farmacie WHERE codf=$id";
        }
        self::$db->query($sql);
        return $this->respondDeleted($id);
    }
    
    private function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
    
    private function getFarmacie($row) {
        return Farmacie::newFarmacie($row->codf, $row->filiala, $row->activa);
    }
}