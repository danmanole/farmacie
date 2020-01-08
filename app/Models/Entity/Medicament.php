<?php
namespace App\Models\Entity;

class Medicament {
    public $codm;
    public $prod;
    public $den;
    public $pret;
    public $stoc;
    public $data_exp;
    public $prescriptie;
    public $nat_exp;
    public $nat_suba;
    public $suba;
    public $mod_a;
    public $mod_p;
    public $contraindicatii;
    public $continut;
    
    public static function newMedicament($codm, $prod, $den, $pret, $stoc, $data_exp,
        $prescriptie, $nat_exp, $nat_suba, $suba, $mod_a, $mod_p, $contraindicatii, $continut) {
        $medicament = new Medicament();
        $medicament->codm = $codm;
        $medicament->prod = $prod;
        $medicament->den = $den;
        $medicament->pret = $pret;
        $medicament->stoc = $stoc;
        $medicament->data_exp = $data_exp;
        $medicament->prescriptie = $prescriptie;
        $medicament->nat_exp = $nat_exp;
        $medicament->nat_suba = $nat_suba;
        $medicament->suba = $suba;
        $medicament->mod_a = $mod_a;
        $medicament->mod_p = $mod_p;
        $medicament->contraindicatii = $contraindicatii;
        $medicament->continut = $continut;
        return $medicament;
    }
}