<?php
namespace App\Models\Entity;

class Vanzare {
    public $codv;
    public $cant;
    public $codm;
    public $codr;
    public $pret;
    public $data_vanz;
    
    public static function newVanzare($codv, $cant, $codm, $codr, $pret, $data_vanz) {
        $vanzare = new Vanzare();
        $vanzare->codv = $codv;
        $vanzare->cant = $cant;
        $vanzare->codm = $codm;
        $vanzare->codr = $codr;
        $vanzare->pret = $pret;
        $vanzare->data_vanz = $data_vanz;
        return $vanzare;
    }
    
}