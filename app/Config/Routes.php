<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Accueil;
use App\Controllers\Compte;
use App\Controllers\Actualite;
use App\Controllers\Concours;
use App\Controllers\Candidature;

/**
 * @var RouteCollection $routes
 */

 /*==============================================================
        ROUTES DES AFFICHAGE DES BOOTSTRAP
==============================================================*/

$routes->get('/', [Accueil::class, 'afficher']);
$routes->get('accueil/afficher_bf', [Accueil::class, 'afficher_backoffice']);

/*==============================================================
        ROUTES DES COMPTES
==============================================================*/

$routes->get('compte/lister', [Compte::class, 'lister2']);
/*$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);
ces deux lignes peuvent être condensées en une seule ligne (celle d'en dessours)*/

$routes->match(["get","post"],'compte/creer', [Compte::class, 'creer']);
$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);
$routes->get('compte/informer', [Compte::class, 'informer']);
$routes->match(["get","post"],'compte/modifier', [Compte::class, 'modifier']);
$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);

/*==============================================================
        ROUTES DES ACTUALITES
==============================================================*/

$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);


/*==============================================================
        ROUTES DES CONCOURS
==============================================================*/

$routes->get('concours/afficher', [Concours::class, 'afficher']);
$routes->get('concours/afficher/(:num)', [Concours::class, 'afficher_info']);

$routes->get('concours/gerer', [Concours::class, 'gerer']);
$routes->get('concours/juger', [Concours::class, 'juger']);
$routes->get('concours/selectionner/(:num)', [Concours::class, 'selectionner']);
$routes->get('concours/candidats_afficher/(:num)', [Concours::class, 'afficher_candidats']);
$routes->get('concours/candidature_afficher/(:num)', [Concours::class, 'afficher_candidat']);
$routes->get('concours/informer/(:num)', [Concours::class, 'informer']);

$routes->match(["get","post"],'concours/creer', [Concours::class, 'creer']);
$routes->get('concours/supprimer/(:segment)', [Concours::class, 'supprimer']);


/*==============================================================
        ROUTES DES CANDIDATURES
==============================================================*/

//$routes->get('candidature/afficher/(:segment)', [Candidature::class, 'afficher']);
$routes->get('candidature/connecter', [Candidature::class, 'connecter']);
$routes->post('candidature/connecter', [Candidature::class, 'connecter']);
//$routes->get('candidature/afficher/(:segment)/(:segment)', [Candidature::class, 'afficher2']);
$routes->get('candidature/supprimer/(:segment)/(:segment)', [Candidature::class, 'supprimer']);