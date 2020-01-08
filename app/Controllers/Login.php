<?php
namespace App\Controllers;

use App\Models\Services\UserService;

class Login extends BaseController {
    

    /*
     * login/login
     */
    public function login()
    {
        return view('login');
    }
    
    /*
     * login/login_validation 
     */
    public function login_validation() {
        UserService::init();
        $username = trim($this->request->getVar('uname'));
        $password = trim($this->request->getVar('psw'));
        
        if (!empty($username) && !empty($password)) {
            $user = UserService::getUser($username);
            if (isset($user)) {
                $ok = UserService::isUserPassword($user, $password);
                if ($ok && $user->activ) {
                    $session_data = array(
                        'username' => $username,
                        'id' => $user->id,
                        'nivelAcces' => $user->nivelAcces,
                        'job' => $user->job,
                        'activ' => $user->activ
                    );
                    $this->session->set($session_data);
                    return redirect()->to($this->mainPath . 'home/farmacie');
                }
            }
        }
        return $this->login();
    }
    
}