<?php
namespace App\Models\Services;

class RenderService {

    /**
     * Creaza bara de meniuri
     * @param string $active ce titlu trebuie sa fie activ 
     * @param boolean $isAdmin true pentru administrator, false pentru farmacist
     * @return string HTML
     */
	public static function bara($active, $isAdmin) {
		$html = '<div class="bara">';
		$html.= '<ul id="bara">';
		$links = array(
			'vanzare' => 'Vanzare',
		    'medicament' => 'Medicament',
		    'reteta' => 'Reteta',
		    'client' => 'Client',
		    'rapoarte' => 'Rapoarte',
		    'administrare' => 'Administrare',
			'login' => 'Logout'
			/*,
		    'contact' => 'Contact'
		    */
		    
		);
			
		foreach ($links as $link=>$titlu) {
		    if (!$isAdmin) {
		        switch ($titlu) {
		            case 'Rapoarte':
		            case 'Administrare':
		                continue;
		        }
		    }
			$activePart = ($titlu === $active) ? 'class="active"' :'';
			$style = ($titlu === 'Contact') ? 'style="float:right"' : '';
			$html .= "<li$style><a $activePart href=\"$link\">$titlu</a></li>";
		}
		$html .= "</ul></div>\n";
		
		return $html;
	}
}