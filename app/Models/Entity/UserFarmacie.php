<?php
namespace App\Models\Entity;

class UserFarmacie {
    
    public $codf;
    public $codu;
    
    public static function newUserFarmacie($codf, $codu) {
        $userFarmacie = new UserFarmacie();
        $userFarmacie->codf = $codf;
        $userFarmacie->codu = $codu;
        return $userFarmacie;
    }
}