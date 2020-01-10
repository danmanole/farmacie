<?php
namespace App\Models\Services;

class RenderService {

    /**
     * Creaza bara de meniuri
     * @param string $active ce titlu trebuie sa fie activ 
     * @param boolean $isAdmin true pentru administrator, false pentru farmacist
     * @return string HTML
     */
	public static function bara($active, $job) {
		$html = '<div class="bara">';
		$html.= '<ul id="bara">';
		$links = array(
			'vanzare' => 'Vanzare',
		    'medicament' => 'Medicament',
		    'reteta' => 'Reteta',
		    'rapoarte' => 'Rapoarte',
		    'administrare' => 'Administrare',
			'../login/login' => 'Logout'
		);
			
		foreach ($links as $link=>$titlu) {
		    $ok = true;
		    switch($job){
		        case 'Farmacist':
    		        switch ($titlu) {
    		            case 'Rapoarte':
    		            case 'Administrare':
    		                $ok = false;
    		                break;
    		        }
    		        break;
		        case 'Administrator':
		            switch ($titlu) {
		                case 'Rapoarte':
		                case 'Reteta':
		                case 'Medicament':
		                case 'Vanzare':
		                    $ok = false;
		                    break;
		            }
		            break;
		        case 'Contabil':
		            switch($titlu) {
		                case 'Vanzare':
		                case 'Reteta':
		                case 'Administrare':
		                    $ok = false;
		                    break;
		            }
		            break;
		        case 'Farmacist sef':
		            switch($titlu) {
		                case 'Administrare':
		                    $ok = false;
		                    break;
		            }
		            break;
		    }
		    
		    if ($ok) {
    			$activePart = ($titlu === $active) ? 'class="active"' :'';
    			$html .= "<li><a $activePart href=\"$link\">$titlu</a></li>";
		    }
		}
		$html .= "</ul></div>\n";
	
		return $html;
	}
}