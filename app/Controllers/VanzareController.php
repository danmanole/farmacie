<?php 
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Services\DBService;
use App\Models\Entity\Vanzare;

class VanzareController extends ResourceController {
    protected $format = 'json';
    static $db;
    
    /**
     * /vanzareController/create
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::create()
     */
    public function create() {
        $this->init();
        $data = $this->request->getPost();
        $codf = $this->getFarmacie($data);
        
        $sql = "INSERT INTO vanzare VALUES(null, $data[cant], $data[codm], "
            . " $data[codr], (SELECT pret FROM medicament WHERE codm=$data[codm]), '$data[data_vanz]', $codf)";
        self::$db->query($sql);
        $id = self::$db->insertID();
        $sql = "UPDATE medicament SET stoc=stoc-$data[cant] WHERE codm=$data[codm]";
        self::$db->query($sql);
        return $this->respondCreated($id);
    }
    
    private function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
    
    /**
     * Cand se introduce o factura, se folosete farmacia la care este angajat utilizatorul curent
     */
    private function getFarmacie($data) {
        $codu = $data['userId'];
        $sql = "SELECT codf FROM users_farmacie WHERE codu=$codu";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (!empty($rows)) {
            return $rows[0]->codf;
        } else {
            return -1;
        }
    }
}