<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Services\DBService;
use App\Models\Entity\Client;

class ClientController extends ResourceController {
    protected $format = 'json';
    static $db;
    
    /**
     * /clientController/$term
     * @param string $term
     * @return mixed|\CodeIgniter\HTTP\Message|\CodeIgniter\HTTP\Response
     */
    public function search($term) {
        $this->init();
        $sql = "SELECT * FROM client WHERE nume LIKE '%$term%' OR prenume LIKE '%$term%'";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $clienti = array();
        foreach ($rows as $row) {
            $clienti[] = $this->getClient($row);
        }
        return $this->respond($clienti);
    }
    
    /**
     * /clientController/show/$id
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::show()
     */
    public function show($id = null) {
        $this->init();
        $sql = "SELECT * FROM client where codc=$id";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (!empty($rows)) {
            return $this->respond($this->getClient($rows[0]));
        }
        return $this->respond([]);
    }
    
    private function getClient($row) {
        return Client::newClient($row->codc, $row->nume, $row->prenume, $row->sex, $row->varsta);
    }
    
    private function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
}