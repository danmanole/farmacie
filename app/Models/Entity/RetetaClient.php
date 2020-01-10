<?php
namespace App\Models\Entity;

class RetetaClient {
    public $codc;
    public $nume;
    public $prenume;
    public $doctor;
    public $codr;
    public $data_elib;
    public $tip;
    
    public static function newRetetaClient($codc, $nume, $prenume, $doctor, $codr, $data_elib, $tip) {
        $newRClient = new RetetaClient();
        $newRClient->codc = $codc;
        $newRClient->nume = $nume;
        $newRClient->prenume = $prenume;
        $newRClient->doctor = $doctor;
        $newRClient->codr = $codr;
        $newRClient->data_elib = $data_elib;
        $newRClient->tip = $tip;
        return $newRClient;
    }
}