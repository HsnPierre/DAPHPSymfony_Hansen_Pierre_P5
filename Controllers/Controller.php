<?php
namespace App\Controllers;

class Controller
{
    public function render(string $fichier, array $donnees = [], string $template = 'template')
    {
        extract($donnees);

        ob_start();

        require_once ROOT.'/Views/'.$fichier.'.php';

        $content = ob_get_clean();

        require_once ROOT.'/Views/'.$template.'.php';
    }
}