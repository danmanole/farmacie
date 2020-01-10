<?php
namespace App\Models\Entity;

class Client {
    public $codc;
    public $nume;
    public $prenume;
    public $sex;
    public $varsta;
    
    public static function newClient($codc, $nume, $prenume, $sex, $varsta) {
        $client = new Client();
        $client->codc = $codc;
        $client->nume = $nume;
        $client->prenume = $prenume;
        $client->sex = $sex;
        $client->varsta = $varsta;
        return $client;
    }
    
}