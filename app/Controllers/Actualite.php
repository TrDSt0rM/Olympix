<?php

namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Actualite extends BaseController
{
    public function __construct()
    {
        //...
    }
    public function afficher($numero = 0)
    {
        $model = model(Db_model::class);
        if ($numero == 0) {
            return redirect()->to('/');
        } else {
            $data['titre'] = 'Actualité :';
            $data['news'] = $model->get_actualite($numero);
            $data['menu'] = $model->get_all_concours_menu();
            return view('templates/haut', $data)
                . view('templates/menu_visiteur')
                . view('templates/menu_carousel')
                . view('affichage_actualite')
                . view('templates/bas');
        }
    }
}
