<?php
namespace App\Models\Entity;

class User {
    
    public $id;
    public $userName;
    public $userPassword;
    public $nivelAcces;
    public $job;
    public $activ;
    
    public static function newUser ($id, $userName, $userPassword, $nivelAcces, $job, $activ) {
        $user = new User();
        $user->id = $id;
        $user->userName = $userName;
        $user->userPassword = $userPassword;
        $user->nivelAcces = $nivelAcces;
        $user->job = $job;
        $user->activ = $activ;
        return $user;
    }

}