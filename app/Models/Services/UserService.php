<?php
namespace App\Models\Services;

use App\Models\Entity\User;

class UserService {
    
    static $db;
    
    public static function init() {
        $dbService = new DBService();
        self::$db = $dbService->getDB();
    }
    
    public static function getUser($userName) {
        $sql = "SELECT * FROM users WHERE lower(user)=lower('$userName') limit 1";
        $query = self::$db->query($sql);
        $rows = $query->getResult();
        foreach ($rows as $row) {
            return User::newUser($row->codu, $row->user, $row->password, $row->nivel_acces, $row->job, $row->activ);
        }
        return null;
    }
    
    public static function isUserPassword($user, $userPassword) {
        if (isset($user)) {
            return $user->userPassword === $userPassword;
        } else {
            return false;
        }
    }
}