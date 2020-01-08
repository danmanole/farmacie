<?php namespace App\Controllers;

use App\Models\Services\RenderService;

class Home extends BaseController
{
    
    const FARMACIE = 'farmacie';
    
	public function index()
	{
		return view('login');
	}

	//--------------------------------------------------------------------
	
	/*
	 * home/farmacie
	 */
	public function farmacie() {
	    $info = $this->informatii();
	    return view(self::FARMACIE, $info);
	}

    /*
     * home/logout
     */
	public function logout() {
	    $this->session->remove('username');
	    return redirect()->to($this->mainPath . 'login/login');
	}
	
	/*
	 * home/administrare
	 */
	public function administrare() {
	    $info = $this->informatii();
	    $info['script'] = 'AdministrareForm.js';
	    $info['content'] = 'administration.php';
	    return view(self::FARMACIE, $info);
	}
	
	/*
	 * home/rapoarte
	 */
	public function rapoarte() {
	    $info = $this->informatii();
	    return view(self::FARMACIE, $info);
	}
	
	/*
	 * home/vanzare
	 */
	public function vanzare() {
	    $info = $this->informatii();
	    $info['content'] = 'vanzare.php';
	    return view(self::FARMACIE, $info);
	}
	
	/*
	 * home/medicament
	 */
	public function medicament() {
	    $info = $this->informatii();
	    $info['script'] = 'MedicamentForm.js';
	    $info['content'] = 'medicament.php';
	    return view(self::FARMACIE, $info);
	}
	
	/*
	 * home/reteta
	 */
	public function reteta() {
	    $info = $this->informatii();
	    return view(self::FARMACIE, $info);
	}
	
	/*
	 * home/client
	 */
	public function client() {
	    $info = $this->informatii();
	    return view(self::FARMACIE, $info);
	}
	
	/**
	 * In functie de nivelul de acces, modifica bara de meniuri
	 * @return string
	 */
	private function informatii() {
	    $nivelAcces = $this->session->get('nivelAcces');
	    $bara = RenderService::bara('', $nivelAcces == 1);
	    $info['bara'] = $bara;
	    $info['job'] = $this->session->get('job');
	    return $info;
	}
}
