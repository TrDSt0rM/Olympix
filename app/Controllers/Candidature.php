<?php

namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Candidature extends BaseController
{
    public function __construct()
    {
        helper('form');
    }
    public function afficher($code = 0)
    {
        $model = model(Db_model::class);
        if ($code == 0) {
            return redirect()->to('/');
        } else {
            $data['titre'] = 'Candidature : ';
            $data['candidature'] = $model->get_candidature($code);
            $data['ressource'] = $model->get_ressource_candidature($code);
            $data['menu'] = $model->get_all_concours_menu();
            return view('templates/haut', $data)
                . view('templates/menu_visiteur')
                . view('templates/menu_carousel')
                . view('affichage_candidature')
                . view('templates/bas');
        }
    }
    public function afficher2($codeI, $codeC)
    {
        $model = model(Db_model::class);
        if ($codeI == 0 || $codeC == 0) {
            return redirect()->to('/');
        } else {
            if ($model->exist_candidature2($codeI, $codeC) == true) {
                $data['titre'] = 'Candidature : ';
                $data['candidature'] = $model->get_candidature2($codeI, $codeC);
                $data['ressource'] = $model->get_ressource_candidature2($codeI, $codeC);
                $data['menu'] = $model->get_all_concours_menu();
                return view('templates/haut', $data)
                    . view('templates/menu_visiteur')
                    . view('templates/menu_carousel')
                    . view('affichage_candidature')
                    . view('templates/bas');
            } else {
                return redirect()->to('/');
            }
        }
    }

    public function connecter()
    {
        $model = model(Db_model::class);
        $data['message'] = "";
        $data['titre'] = "Voir sa candidature";
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod() == "post") {
            if (
                !$this->validate(
                    [
                        'codeI' => 'required',
                        'codeC' => 'required'
                    ],
                    [
                        'codeI' => [
                            'required' => 'Veuillez entrer votre code d\'inscription.',
                        ],
                        'codeC' => [
                            'required' => 'Veuillez entre votre code de candidature.',
                        ],
                    ]
                )
            ) { // La validation du formulaire a échoué, retour au formulaire !
                return view('templates/haut', $data)
                    . view('templates/menu_visiteur')
                    . view('candidature/candidature_connexion')
                    . view('templates/bas');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $codeI = $this->request->getVar('codeI');
            $codeC = $this->request->getVar('codeC');
            if ($model->exist_candidature2($codeI, $codeC) == true) {
                $data['titre'] = 'Candidature : ';
                $data['candidature'] = $model->get_candidature2($codeI, $codeC);
                $data['ressource'] = $model->get_ressource_candidature2($codeI, $codeC);
                $data['menu'] = $model->get_all_concours_menu();
                return view('templates/haut', $data)
                    . view('templates/menu_visiteur')
                    . view('templates/menu_carousel')
                    . view('affichage_candidature')
                    . view('templates/bas');
            } else {
                $data['message'] = 'Couple de codes érronés';
                return view('templates/haut', $data)
                    . view('templates/menu_visiteur')
                    . view('candidature/candidature_connexion')
                    . view('templates/bas');
            }
        }
        // L’utilisateur veut afficher le formulaire pour se connecter
        return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('candidature/candidature_connexion')
            . view('templates/bas');
    }

    public function supprimer($codeI, $codeC)
    {
        $model = model(Db_model::class);
        if ($codeI == 0 || $codeC == 0) {
            return redirect()->to('/');
        } else {
            if ($model->exist_candidature2($codeI, $codeC) == true) {
                $model->supprimer_candidature($codeI, $codeC);
                $data['titre'] = 'Candidature supprimée ';
                return view('templates/haut', $data)
                    . view('templates/menu_visiteur')
                    . view('candidature/candidature_suppression')
                    . view('templates/bas');
            } else {
                return redirect()->to('/');
            }
        }
    }
}
