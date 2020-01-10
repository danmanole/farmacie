<?php
namespace App\Models\Entity;

class Reteta {
    public $codr;
    public $doctor;
    public $diag;
    public $tip;
    public $data_elib;
    public $codc;
    
    public static function newReteta($codr, $doctor, $diag, $tip, $data_elib, $codc) {
        $reteta = new Reteta();
        $reteta->codr = $codr;
        $reteta->doctor = $doctor;
        $reteta->diag = $diag;
        $reteta->tip = $tip;
        $reteta->data_elib = $data_elib;
        $reteta->codc = $codc;
        return $reteta;
    }
}