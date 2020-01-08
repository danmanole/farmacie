<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Services\DBService;
use App\Models\Entity\User;

class UserController extends ResourceController {
    protected $format = 'json';
    static $db;
    
    /**
     * /userController
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::index()
     */
    public function index() {
        $this->init();
        $sql = "SELECT * FROM users";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $users = array();
        foreach ($rows as $row) {
            $users[] = $this->getUser($row);
        }
        return $this->respond($users);
    }
    
    /**
     * /userController/show/$id
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::show()
     */
    public function show($id = null) {
        $this->init();
        $sql = "SELECT * FROM users where codu=$id";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (!empty($rows)) {
            return $this->respond($this->getUser($rows[0]));
        }
        return $this->respond([]);
    }
    
    /**
     * /userController/search/$term
     * @param string $term
     * @return mixed|\CodeIgniter\HTTP\Message|\CodeIgniter\HTTP\Response
     */
    public function search($term) {
        $this->init();
        $sql = "SELECT * FROM users WHERE user LIKE '%$term%'";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        $users = array();
        foreach ($rows as $row) {
            $users[] = $this->getUser($row);
        }
        return $this->respond($users);
    }
    
    /**
     * /userController/create
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::create()
     */
    public function create() {
        $this->init();
        $data = $this->request->getPost();
        $sql = "INSERT INTO users VALUES(null, '$data[userName]', '$data[userPassword]', "
            . "$data[nivelAcces], '$data[job]', true)";
        self::$db->query($sql);
        $id = self::$db->insertID();
        $this->refreshFarmacie($id, $data['farmacie']);
        return $this->respondCreated($id);
    }
    
    /**
     * userController/update
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::update()
     */
    public function update($id = null) {
        $this->init();
        $data = $this->request->getPost();
        $password = $data['userPassword'];
        $sql = "UPDATE users SET user='$data[userName]', "
            . "nivel_acces=$data[nivelAcces], job='$data[job]', activ=$data[activ]";
        if (!empty($password)) {
           $sql .= ", password='$data[userPassword]'";
        }
        $sql .= " WHERE codu=$id";
        self::$db->query($sql);
        $this->refreshFarmacie($id, $data['farmacie']);
        return $this->respond($id);
    }
    
    /**
     * /userController/delete
     * {@inheritDoc}
     * @see \CodeIgniter\RESTful\ResourceController::delete()
     */
    public function delete($id = null) {
        $this->init();
        $sql = "UPDATE users SET activ=0 WHERE codu=$id";
        self::$db->query($sql);
        $this->deleteFarmacie($id);
        return $this->respondDeleted($id);
    }
    
    private function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
    
    private function getUser($row) {
        return User::newUser($row->codu, $row->user, '', $row->nivel_acces, $row->job, $row->activ);
    }
    
    private function refreshFarmacie($idUser, $idFarmacie) {
        $sql = "SELECT * FROM users_farmacie WHERE codu=$idUser LIMIT 1";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        if (empty($rows)) {
            $sql = "INSERT INTO users_farmacie VALUES($idFarmacie, $idUser)";    
        } else {
            $sql = "UPDATE users_farmacie SET codf=$idFarmacie WHERE codu=$idUser";
        }
        self::$db->query($sql);
    }
    
    private function deleteFarmacie($idUser) {
        $sql = "DELETE FROM users_farmacie WHERE codu=$idUser";
        self::$db->query($sql);
    }
}