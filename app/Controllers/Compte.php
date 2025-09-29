<?php

namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Compte extends BaseController
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model = model(Db_model::class);
    }
    public function lister()
    {
        $data['titre'] = "Liste de tous les comptes";
        $data['logins'] = $this->model->get_all_compte();
        $data['nb_compte'] = $this->model->count_compte();
        return view('templates/haut_admin', $data)
            . view('templates/menu_admin')
            . view('affichage_comptes')
            . view('templates/bas_admin');
    }

    public function lister2()
    {
        $session = session();
        if (($session->has('user')) && ($session->get('role') == 'A')) {
            $data['titre'] = "Liste de tous les comptes";
            $data['logins'] = $this->model->get_all_compteV3();
            $data['nb_compte'] = $this->model->count_compte();
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('connexion/compte_affichage')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }

    }

    public function informer()
    {
        $session = session();
        if (($session->has('user')) && ($session->get('role') == 'A')) {
            $data['titre'] = "Informations Personnelles";
            $data['infoperso'] = $this->model->get_info_admin($session->get('user'));
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('connexion/compte_profil')
                . view('templates/bas_admin');
        } else if (($session->has('user')) && ($session->get('role') == 'J')) {
            $data['titre'] = "Informations Personnelles";
            $data['infoperso'] = $this->model->get_info_jury($session->get('user'));
            return view('templates/haut_admin', $data)
                . view('templates/menu_jury')
                . view('connexion/compte_profil')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }

    public function creer()
    {
        $session = session();
        $data['titre'] = 'Créer un compte';
        $data['pseudo_existant'] = "";
        if (($session->has('user')) && ($session->get('role') == 'A')) {
            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            if ($this->request->getMethod() == "post") {
                if (
                    !$this->validate(
                        [
                            'pseudo' => 'required|max_length[45]|min_length[2]',
                            'mdp' => 'required|max_length[32]|min_length[8]',
                            'confirmMdp' => 'required|matches[mdp]',
                            'nom' => 'required|max_length[60]|min_length[2]',
                            'prenom' => 'required|max_length[60]|min_length[2]'
                        ],
                        [
                            'pseudo' => [
                                'required' => 'Veuillez entrer un pseudo pour le compte.',
                                'min_length' => 'Veuillez entrer un pseudo plus long.',
                                'max_length' => 'Veuillez entrer un pseudo plus court.',
                            ],
                            'mdp' => [
                                'required' => 'Veuillez entre un mot de passe.',
                                'min_length' => 'Veuillez entrer un mot de passe plus long.',
                                'max_length' => 'Veuillez entrer un mot de passe plus court.',
                            ],
                            'confirmMdp' => [
                                'required' => 'Veuillez confirmer votre mot de passe.',
                                'matches' => 'les mots de passe ne sont pas similaire.',
                            ],
                            'nom' => [
                                'required' => 'Veuillez entre un nom.',
                                'min_length' => 'Veuillez entrer un nom plus long.',
                                'max_length' => 'Veuillez entrer un nom plus court.',
                            ],
                            'prenom' => [
                                'required' => 'Veuillez entre un prénom.',
                                'min_length' => 'Veuillez entrer un prénom plus long.',
                                'max_length' => 'Veuillez entrer un prénom plus court.',
                            ],
                        ]
                    )
                ) {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/haut_admin', $data)
                        . view('templates/menu_admin')
                        . view('compte/compte_creer')
                        . view('templates/bas_admin');
                }
                // La validation du formulaire a réussi, traitement du formulaire
                $validite = $this->request->getVar('validite');
                $role = $this->request->getVar('role');
                $recuperation = $this->validator->getValidated();
                $username = $recuperation['pseudo'];
                // vérification du duplicatat du login (si oui renvoye le formulaire)
                if ($this->model->login_existant($username) == true) {
                    $data['pseudo_existant'] = "Votre pseudo déjà utilisé";
                    return view('templates/haut_admin', $data)
                        . view('templates/menu_admin')
                        . view('compte/compte_creer')
                        . view('templates/bas_admin');
                } else {
                    $this->model->set_compte($recuperation, $validite);
                    if ($role == 'A') {
                        $this->model->set_admin($recuperation);
                    } else {
                        $this->model->set_jury($recuperation);
                    }
                    $data['titre'] = "Liste de tous les comptes";
                    $data['logins'] = $this->model->get_all_compteV3();
                    $data['nb_compte'] = $this->model->count_compte();

                    $data['le_compte'] = "Le compte " . $recuperation['pseudo'] . " a été ajouté avec succès";
                    $data['le_message'] = "Nouveau nombre de comptes : ";
                    //Appel de la fonction créée dans le précédent tutoriel :
                    $data['le_total'] = $this->model->count_compte();
                    return view('templates/haut_admin', $data)
                        . view('templates/menu_admin')
                        . view('connexion/compte_affichage_succes')
                        . view('templates/bas_admin');
                }
            }
            // L’utilisateur veut afficher le formulaire pour créer un compte
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('compte/compte_creer')
                . view('templates/bas_admin');
        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }

    public function connecter()
    {
        $data['titre'] = "Se connecter";
        $data['message'] = "";
        $data['menu'] = $this->model->get_all_concours_menu();
        // L’utilisateur a validé le formulaire en cliquant sur le bouton
        if ($this->request->getMethod() == "post") {
            if (
                !$this->validate(
                    [
                        'pseudo' => 'required',
                        'mdp' => 'required'
                    ],
                    [
                        'pseudo' => [
                            'required' => 'Veuillez entrer votre pseudo.',
                        ],
                        'mdp' => [
                            'required' => 'Veuillez entre votre mot de passe.',
                        ],
                    ]
                )
            ) { // La validation du formulaire a échoué, retour au formulaire !
                $data['message'] = "";
                return view('templates/haut', $data)
                    . view('templates/menu_visiteur')
                    . view('connexion/compte_connecter')
                    . view('templates/bas');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $username = $this->request->getVar('pseudo');
            $password = $this->request->getVar('mdp');
            if ($this->model->connect_compte2($username, $password) == true) {
                $session = session();
                $session->set('user', $username);
                if ($this->model->get_role($username) == true) {
                    $role = 'A';
                } else {
                    $role = "J";
                }
                $session->set('role', $role);
                if ($session->get('role') == 'A') {
                    return view('templates/haut_admin')
                        . view('templates/menu_admin')
                        . view('connexion/compte_accueil')
                        . view('templates/bas_admin');
                } else {
                    return view('templates/haut_admin')
                        . view('templates/menu_jury')
                        . view('connexion/compte_accueil')
                        . view('templates/bas_admin');
                }

            } else {
                $data['message'] = "<br />Identifiants erronés ou inexistants !";
                return view('templates/haut', $data)
                    . view('templates/menu_visiteur')
                    . view('connexion/compte_connecter')
                    . view('templates/bas');
            }
        }
        // L’utilisateur veut afficher le formulaire pour se connecter
        return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }

    public function modifier()
    {
        $session = session();

        // Update du profil si l'utilisateur est un admin
        if ($session->has('user') && $session->get('role') == 'A') {
            $data['titre'] = 'Modifier le profil';
            $data['infos'] = $this->model->get_info_perso($session->get('user'));

            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            if ($this->request->getMethod() == "post") {
                if (
                    !$this->validate(
                        [
                            'mdp' => 'required|max_length[32]|min_length[8]',
                            'confirmMdp' => 'required|matches[mdp]',

                        ],
                        [
                            'mdp' => [
                                'required' => 'Veuillez entre un mot de passe.',
                                'min_length' => 'Veuillez entrer un mot de passe plus long.',
                                'max_length' => 'Veuillez entrer un mot de passe plus court.',
                            ],
                            'confirmMdp' => [
                                'required' => 'Veuillez confirmer votre mot de passe.',
                                'matches' => 'Confirmation du mot de passe erronée, veuillez réessayer !',
                            ],
                        ]
                    )
                ) {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/haut_admin', $data)
                        . view('templates/menu_admin')
                        . view('compte/compte_modifier')
                        . view('templates/bas_admin');
                }
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();
                $this->model->edit_profil($recuperation, $session->get('user'));

                $data['titre'] = "Informations Personnelles";
                $data['infoperso'] = $this->model->get_info_admin($session->get('user'));
                return view('templates/haut_admin', $data)
                    . view('templates/menu_admin')
                    . view('compte/profil_succes')
                    . view('templates/bas_admin');
            }
            // L’utilisateur veut afficher le formulaire pour créer un compte
            return view('templates/haut_admin', $data)
                . view('templates/menu_admin')
                . view('compte/compte_modifier')
                . view('templates/bas_admin');

            // Update du profil si l'utilisateur est un admin
        } elseif ($session->has('user') && $session->get('role') == 'J') {
            $data['titre'] = 'Modifier le profil';
            $data['infos'] = $this->model->get_info_perso($session->get('user'));

            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            if ($this->request->getMethod() == "post") {
                if (
                    !$this->validate(
                        [
                            'mdp' => 'required|max_length[32]|min_length[8]',
                            'confirmMdp' => 'required|matches[mdp]',

                        ],
                        [
                            'mdp' => [
                                'required' => 'Veuillez entre un mot de passe.',
                                'min_length' => 'Veuillez entrer un mot de passe plus long.',
                                'max_length' => 'Veuillez entrer un mot de passe plus court.',
                            ],
                            'confirmMdp' => [
                                'required' => 'Veuillez confirmer votre mot de passe.',
                                'matches' => 'les mots de passe ne sont pas similaire.',
                            ],
                        ]
                    )
                ) {
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/haut_admin', $data)
                        . view('templates/menu_jury')
                        . view('compte/compte_modifier')
                        . view('templates/bas_admin');
                }
                // La validation du formulaire a réussi, traitement du formulaire
                $recuperation = $this->validator->getValidated();
                $this->model->edit_profil($recuperation, $session->get('user'));

                $data['titre'] = "Informations Personnelles";
                $data['infoperso'] = $this->model->get_info_jury($session->get('user'));
                return view('templates/haut_admin', $data)
                    . view('templates/menu_jury')
                    . view('compte/profil_succes')
                    . view('templates/bas_admin');
            }
            // L’utilisateur veut afficher le formulaire pour créer un compte
            return view('templates/haut_admin', $data)
                . view('templates/menu_jury')
                . view('compte/compte_modifier')
                . view('templates/bas_admin');

        } else {
            // si l'utilisateur n'est pas connecté et essaie de passer par l'url
            return redirect()->to('/compte/deconnecter');
        }
    }

    public function deconnecter()
    {
        $session = session();
        $session->destroy();
        $data['titre'] = "Se connecter";
        $data['message'] = "";
        $data['menu'] = $this->model->get_all_concours_menu();
        return view('templates/haut', $data)
            . view('templates/menu_visiteur')
            . view('connexion/compte_connecter')
            . view('templates/bas');
    }
}