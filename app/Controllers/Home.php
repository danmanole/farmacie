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
	    $info['script'] = 'RaportForm.js';
	    $info['content'] = 'raport.php';
	    return view(self::FARMACIE, $info);
	}
	
	/*
	 * home/vanzare
	 * home/vanzare/codreteta
	 */
	public function vanzare($codr = null) {
	    $info = $this->informatii();
	    $info['script'] = 'VanzareForm.js';
	    $info['content'] = 'vanzare.php';
	    $info['codr'] = $codr;
	    $info['userId'] = $this->session->get('id');
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
	    $info['script'] = 'RetetaForm.js';
	    $info['content'] = 'reteta.php';
	    return view(self::FARMACIE, $info);
	}
	
	/**
	 * In functie de job, modifica bara de meniuri
	 * @return string
	 */
	private function informatii() {
	    $job = $this->session->get('job');
	    $bara = RenderService::bara('', $job);
	    $info['bara'] = $bara;
	    $info['job'] = $job;
	    return $info;
	}
}
