<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Services\DBService;
use App\Models\Entity\UserFarmacie;

class UsersFarmacieController extends ResourceController {
    protected $format = 'json';
    static $db;
    
    /**
     * /usersFarmacieController/showf/$codu
     * Afiseaza farmacie pentru un utilizator
     * @param integer $codu
     * @return mixed|\CodeIgniter\HTTP\Message|\CodeIgniter\HTTP\Response
     */
    public function showf($codu = null) {
        $this->init();
        $sql = "SELECT * FROM users_farmacie where codu=$codu";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (!empty($rows)) {
            return $this->respond($this->getUserFarmacie($rows[0]));
        }
        return $this->respond([]);
    }
    
    private function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
    
    private function getUserFarmacie($row) {
        return UserFarmacie::newUserFarmacie($row->codf, $row->codu);
    }
}