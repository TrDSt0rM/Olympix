<?php

namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Accueil extends BaseController
{
    public function afficher()
    {
        $model = model(Db_model::class);
        $data['titre_actu'] = "Actualités :";
        $data['titre_concours'] = "Concours :";
        $data['actualites'] = $model->get_all_actualite();
        $data['concours'] = $model->get_all_concours();
        $data['menu'] = $model->get_all_concours_menu();
        return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('templates/menu_carousel')
            . view('affichage_accueil')
            . view('templates/bas');
    }

    public function afficher_backoffice()
    {
        return view('templates/haut_admin')
            . view('templates/menu_admin')
            . view('affichage_accueil_admin')
            . view('templates/bas_admin');
    }
}
