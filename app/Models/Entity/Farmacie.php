<?php
namespace App\Models\Entity;

class Farmacie {
    
    public $codf;
    public $filiala;
    public $activa;
    
    
    public static function newFarmacie($codf, $filiala, $activa) {
        $newFarmacie = new Farmacie();
        $newFarmacie->codf = $codf;
        $newFarmacie->filiala = $filiala;
        $newFarmacie->activa = $activa;
        return $newFarmacie;
    }
}