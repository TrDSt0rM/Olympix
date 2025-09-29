<?php

namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time;

class Concours extends BaseController
{
    public function __construct()
    {
        helper('form');
    }
    public function afficher()
    {
        $model = model(Db_model::class);
        $data['titre'] = "Les Concours";
        $data['concours'] = $model->get_all_concours_V2();
        $data['menu'] = $model->get_all_concours_menu();
        return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('templates/menu_carousel')
            . view('affichage_concours')
            . view('templates/bas');
    }

    public function afficher_info($id = 0)
    {
        $model = model(Db_model::class);
        if ($id == 0) {
            return redirect()->to('/');
        } else {
            $data['con'] = $model->get_concours_by_id($id);
            $data['jury'] = $model->get_jury_concours_by_id($id);
            $data['menu'] = $model->get_all_concours_menu();
            return view('templates/haut', $data)
                . view('templates/menu_visiteur')
                . view('templates/menu_carousel')
                . view('affichage_info_concours')
                . view('templates/bas');
        }
    }

    public function selectionner($id_concours)
    {
        $model = model(Db_model::class);
        $data['titre'] = "Les Candidats";
        $data['candidats'] = $model->get_all_candidats($id_concours);
        $data['categories'] = $model->get_all_categorie_candidats($id_concours);
        $data['ressources'] = $model->get_all_ressources_candidats($id_concours);
        return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('affichage_concours_candidature')
            . view('templates/bas');
    }

    public function gerer()
    {
        $model = model(Db_model::class);
        $session = session();
        if (($session->has('user')) && ($session->get('role') == 'A')) {
            $data['titre'] = "Les Concours";
            $data['concours'] = $model->get_all_concours_admin();
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('connexion/compte_concours_admin')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }
    public function juger()
    {
        $model = model(Db_model::class);
        $session = session();
        if (($session->has('user')) && ($session->get('role') == 'J')) {
            $data['titre'] = "Les Concours";
            $data['concours'] = $model->get_all_concours_jury($session->get('user'));
            return view('templates/haut_admin', $data)
                . view('templates/menu_jury')
                . view('connexion/compte_concours_jury')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }

    public function afficher_candidats($id_concours)
    {
        $model = model(Db_model::class);
        $session = session();
        if (($session->has('user')) && ($session->get('role') == 'J')) {
            $data['titre'] = "Les Candidats";
            $data['candidature'] = $model->get_all_candidature_admin($id_concours);
            return view('templates/haut_admin', $data)
                . view('templates/menu_jury')
                . view('connexion/compte_candidats_preselect')
                . view('templates/bas_admin');
        } elseif (($session->has('user')) && ($session->get('role') == 'A')) {
            $data['titre'] = "Les Candidats";
            $data['candidature'] = $model->get_all_candidature_admin($id_concours);
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('connexion/compte_candidats_preselect')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }

    public function afficher_candidat($id_candidature)
    {
        $model = model(Db_model::class);
        $session = session();
        if (($session->has('user')) && ($session->get('role') == 'J')) {
            $data['titre'] = "Candidature";
            $data['candidature'] = $model->get_candidature_admin($id_candidature);
            $data['ressources'] = $model->get_ressource_candidature_admin($id_candidature);
            return view('templates/haut_admin', $data)
                . view('templates/menu_jury')
                . view('connexion/compte_candidat_afficher')
                . view('templates/bas_admin');
        } elseif (($session->has('user')) && ($session->get('role') == 'A')) {
            $data['titre'] = "Candidature";
            $data['candidature'] = $model->get_candidature_admin($id_candidature);
            $data['ressources'] = $model->get_ressource_candidature_admin($id_candidature);
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('connexion/compte_candidat_afficher')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }

    public function informer($id_concours)
    {
        $model = model(Db_model::class);
        $session = session();
        if (($session->has('user')) && ($session->get('role') == 'J')) {
            $data['con'] = $model->get_concours_by_id($id_concours);
            $data['jury'] = $model->get_jury_concours_by_id($id_concours);
            return view('templates/haut_admin', $data)
                . view('templates/menu_jury')
                . view('concours/concours_informer')
                . view('templates/bas_admin');
        } elseif (($session->has('user')) && ($session->get('role') == 'A')) {
            $data['con'] = $model->get_concours_by_id($id_concours);
            $data['jury'] = $model->get_jury_concours_by_id($id_concours);
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('concours/concours_informer')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }
    public function creer()
    {
        $session = session();
        $model = model(Db_model::class);
        $data['titre'] = 'Créer un concours';
        $data['message_date_avant'] = "";
        if (($session->has('user')) && ($session->get('role') == 'A')) {
            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            if ($this->request->getMethod() == "post") {
                if (
                    !$this->validate(
                        [
                            'nom' => 'required|max_length[100]|min_length[3]',
                            'description' => 'required|max_length[500]',
                            'date_debut' => 'required',
                            'tps_candidature' => 'required|integer',
                            'tps_preselection' => 'required|integer',
                            'tps_finale' => 'required|integer',
                            'discipline' => 'required|max_length[100]',
                        ],
                        [
                            'nom' => [
                                'required' => 'Veuillez entrer un nom au concours.',
                                'min_length' => 'Veuillez entrer un nom plus long.',
                                'max_length' => 'Veuillez entrer un nom plus court.',
                            ],
                            'description' => [
                                'required' => 'Veuillez écrire une description.',
                                'max_length' => 'Veuillez écrire une description plus courte.',
                            ],
                            'date_debut' => [
                                'required' => 'Veuillez choisir une date.',
                                'greater_than' => 'Veuillez entrer une date à venir',
                            ],
                            'tps_candidature' => [
                                'required' => 'Veuillez entrer une durée.',
                                'integer' => 'Veuillez entrer un entier comme durée.',
                            ],
                            'tps_preselection' => [
                                'required' => 'Veuillez entrer une durée.',
                                'integer' => 'Veuillez entrer un entier comme durée.',
                            ],
                            'tps_finale' => [
                                'required' => 'Veuillez entrer une durée.',
                                'integer' => 'Veuillez entrer un entier comme durée.',
                            ],
                            'discipline' => [
                                'required' => 'Veuillez entrer la discipline.',
                                'max_length' => 'Veuillez entrer une discipline plus courte.',
                            ],
                        ]
                    )
                ) {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/haut_admin', $data)
                        . view('templates/menu_admin')
                        . view('concours/concours_creer')
                        . view('templates/bas_admin');
                }
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();
                $date = Time::parse($recuperation['date_debut']);
                if ($date->isAfter(Time::today())) {
                    //la date du début de concours est supérieur à la date du jour  
                    $login = $session->get('user');
                    $model->set_concours($recuperation, $login);
                    return redirect()->to('/concours/gerer');
                } else {
                    //la date du début de concours est inférieur à la date du jour
                    $data['message_date_avant'] = "Veuillez entrer une date à venir";
                    return view('templates/haut_admin', $data)
                        . view('templates/menu_admin')
                        . view('concours/concours_creer')
                        . view('templates/bas_admin');
                }



            }
            // L’utilisateur veut afficher le formulaire pour créer un compte
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('concours/concours_creer')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }

    public function supprimer($id_concours)
    {
        $model = model(Db_model::class);
        $session = session();
        if (($session->has('user')) && ($session->get('role') == 'A')) {
            if (strlen($id_concours) == 21) {
                $id = substr($id_concours, -11, 1);
            } elseif (strlen($id_concours) == 22) {
                $id = substr($id_concours, -11, 2);
            } else {
                return redirect()->to('/concours/gerer');
            }
            $model->supprimer_concours($id);
            return redirect()->to('/concours/gerer');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }
}
