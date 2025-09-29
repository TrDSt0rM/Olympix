<?php

/****************************************************************************

    NAME FILE : Db_model.php

  =========================================================================

    DESCRIPTION : Fichier qui charge la base de données
                : Fichier contenant toutes les gestions CRUD d'OlymPix

  =========================================================================

    AUTHOR : Alex PLOCIENNIK

  =========================================================================

    DATE LAST EDIT : 24/11/24
    VERSION : V1.2

 ***************************************************/

namespace App\Models;

use CodeIgniter\Model;

class Db_model extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = db_connect(); //charger la base de données
        // ou
        // $this->db = \Config\Database::connect();
    }

    /*==============================================================
        FONCTION DES ACTUALITES
    ==============================================================*/

    // Fonction qui récupère une actualité par son ID
    public function get_actualite($numero)
    {
        $requete = "SELECT * FROM t_actualite_act WHERE act_id=" . $numero . ";";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    // requête qui récupère toutes les données des (5 dernières) 
    // actualités de la table des actualités, de l'actualité la plus récente à l'actualité la plus ancienne.

    public function get_all_actualite()
    {
        $resultat = $this->db->query("SELECT * FROM t_actualite_act WHERE act_etat = 'P' ORDER BY act_date DESC LIMIT 5;");
        return $resultat->getResultArray();
    }

    /*==============================================================
        FONCTION DES CANDIDATURES
    ==============================================================*/

    // Vérifie qu'il existe une candidature avec comme code d'inscription le code entré en paramètres
    public function exist_candidature($code)
    {
        $requete = "SELECT COUNT(*) AS existe FROM t_candidature_can LEFT JOIN t_ressource_res USING (can_id) WHERE can_code_inscription='" . $code . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    // Vérifie qu'il existe une candidature avec comme code d'inscription et de candidature les codes entrés en paramètres
    public function exist_candidature2($codeI, $codeC)
    {
        $requete = "SELECT res_id FROM t_candidature_can LEFT JOIN t_ressource_res USING (can_id) 
        WHERE can_code_candidat='" . htmlspecialchars(addslashes($codeC)) . "' AND can_code_inscription='" . htmlspecialchars(addslashes($codeI)) . "';";
        $resultat = $this->db->query($requete);
        if ($resultat->getNumRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Requête qui récupère les informations générales d'une candidature grâce à son code d'inscription entré en paramètre
    public function get_candidature($code)
    {
        $requete = "SELECT can_email, can_nom, can_prenom, can_code_inscription, can_code_candidat, can_presentation, can_etat, can_date, con_nom, cat_nom, res_nom, res_type FROM t_candidature_can LEFT JOIN t_ressource_res USING (can_id) JOIN t_concours_con USING (con_id) JOIN t_categorie_cat USING (cat_id) WHERE can_code_inscription='" . $code . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    // Requête qui récupère les informations générales d'une candidature grâce à ses codes d'inscription et de candidatures entrés en paramètre.
    public function get_candidature2($codeI, $codeC)
    {
        $requete = "SELECT can_email, can_nom, can_prenom, can_code_inscription, can_code_candidat, can_presentation, can_etat, can_date, con_nom, cat_nom, res_nom, res_type 
        FROM t_candidature_can LEFT JOIN t_ressource_res USING (can_id) JOIN t_concours_con USING (con_id) JOIN t_categorie_cat USING (cat_id) 
        WHERE can_code_candidat='" . htmlspecialchars(addslashes($codeC)) . "' AND can_code_inscription='" . htmlspecialchars(addslashes($codeI)) . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    // Requête qui récupère les ressources d'une candidature grâce à son code d'inscription entré en paramètre
    public function get_ressource_candidature($code)
    {
        $requete = "SELECT res_nom, res_type, res_description FROM t_ressource_res JOIN t_candidature_can USING (can_id) WHERE can_code_inscription='" . $code . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // Requête qui récupère les ressources d'une candidature grâce à son code d'inscription et de candidatures entrés en paramètre
    public function get_ressource_candidature2($codeI, $codeC)
    {
        $requete = "SELECT res_nom, res_type, res_description FROM t_ressource_res JOIN t_candidature_can USING (can_id) 
        WHERE can_code_candidat='" . htmlspecialchars(addslashes($codeC)) . "' AND can_code_inscription='" . htmlspecialchars(addslashes($codeI)) . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // Fonction qui appelle la procédure supprimer_candidature qui supprime la candidature et les ressources associées de la candidature grâce à ses codes
    public function supprimer_candidature($codeI, $codeC)
    {
        return $this->db->query("CALL supprimer_candidature('" . htmlspecialchars(addslashes($codeI)) . "', '" . htmlspecialchars(addslashes($codeC)) . "');");
    }

    // Requête qui récupère toutes les informations des candidatures pour un concours dont son id est entré en paramètres afin de réaliser l'affichage des candidats dans le backoffice
    public function get_all_candidature_admin($id_concours){
        $resultat = $this->db->query("SELECT can_id, can_nom, can_prenom, can_etat, can_date, cat_nom FROM t_candidature_can JOIN t_categorie_cat USING (cat_id) WHERE con_id ='" . $id_concours . "' ORDER BY cat_id;");
        return $resultat->getResultArray();
    }

    // Requête qui récupère toutes les informations d'une candidature dont  l'id est entré en paramètres afin de réaliser l'affichage de la candidature dans le backoffice
    public function get_candidature_admin($can_id){
        $resultat = $this->db->query("SELECT can_email, can_nom, can_prenom, can_presentation, can_etat, can_date, cat_nom FROM t_candidature_can JOIN t_categorie_cat USING (cat_id) WHERE can_id ='" . $can_id . "';");
        return $resultat->getResultArray();
    }
    

    // Requête qui récupère toutes les ressources liés à une candidature grâce à l'ID de cette candidature
    public function get_ressource_candidature_admin($can_id){
        $resultat = $this->db->query("SELECT res_nom, res_type, res_description FROM t_ressource_res WHERE can_id='" . $can_id . "';");
        return $resultat->getResultArray();
    }

    /*==============================================================
        FONCTION DES COMPTES
    ==============================================================*/

    // Fonction qui récupère tous les logins des comptes
    public function get_all_compte()
    {
        $resultat = $this->db->query("SELECT cpt_login FROM t_compte_cpt;");
        return $resultat->getResultArray();
    }

    // Fonction qui récupère tous les informations des comptes
    public function get_all_compteV2()
    {
        $resultat = $this->db->query("SELECT * FROM t_compte_cpt;");
        return $resultat->getResultArray();
    }

    // Fonction qui appelle la vue COMPTE qui contient toutes les informations des comptes à mettre dans le tableau des admins
    public function get_all_compteV3()
    {
        $resultat = $this->db->query("SELECT * FROM COMPTES");
        return $resultat->getResultArray();
    }

    // Fonctions qui insert un compte dans la base de donnée
    public function set_compte($saisie, $validite)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $login = htmlspecialchars(addslashes($saisie['pseudo']));
        $mot_de_passe = htmlspecialchars(addslashes($saisie['mdp']));
        $nom = htmlspecialchars(addslashes($saisie['nom']));
        $prenom = htmlspecialchars(addslashes($saisie['prenom']));
        $etat = htmlspecialchars(addslashes($validite));

        $sql = "INSERT INTO t_compte_cpt VALUES('" . $login . "','" . $mot_de_passe . "','" . $prenom . "','" . $nom . "','" . $etat . "');";
        return $this->db->query($sql);
    }

    // Fonction qui insert un compte admin
    public function set_admin($saisie)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $login = htmlspecialchars(addslashes($saisie['pseudo']));
        $sql = "INSERT INTO t_administrateur_adm VALUES('" . $login . "');";
        return $this->db->query($sql);
    }

    // Fonction qui insert un compte jury
    public function set_jury($saisie)
    {
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $login = htmlspecialchars(addslashes($saisie['pseudo']));
        $sql = "INSERT INTO t_compteJury_jur VALUES('Discipline', 'BIO', 'URL', '" . $login . "');";
        return $this->db->query($sql);
    }

    // Fonction qui compte le nombre de compte
    public function count_compte()
    {
        $resultat = $this->db->query("SELECT COUNT(*) AS nb FROM t_compte_cpt;");
        return $resultat->getRow();
    }

    // Fonction qui vérifie si il existe un couple login/mdp
    public function connect_compte($u, $p)
    {
        $sql = "SELECT cpt_login,cpt_mdp FROM t_compte_cpt WHERE cpt_login='" . htmlspecialchars(addslashes($u)) . "' AND cpt_mdp='" . $p . "';";
        $resultat = $this->db->query($sql);
        if ($resultat->getNumRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Fonction qui vérifie si il existe un couple login/mdp avec Hashage
    public function connect_compte2($u, $p)
    {
        $sql = "SELECT cpt_login,cpt_mdp FROM t_compte_cpt WHERE cpt_login='" . htmlspecialchars(addslashes($u)) . "' AND cpt_mdp=SHA2(CONCAT('L3B3urr3S@13CMi3uxQL3B3urr3D0ux.','" . htmlspecialchars(addslashes($p)) . "'),512);";
        $resultat = $this->db->query($sql);
        if ($resultat->getNumRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Fonction qui vérifie si un login existe dans la base de donnée
    public function login_existant($u)
    {
        $sql = "SELECT cpt_login FROM t_compte_cpt WHERE cpt_login='" . htmlspecialchars(addslashes($u)) . "';";
        $resultat = $this->db->query($sql);
        if ($resultat->getNumRows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    // Fonction qui vérifie si le compte est un admin ou un jury
    public function get_role($u)
    {
        $sql = "SELECT cpt_login FROM t_compte_cpt JOIN t_administrateur_adm USING (cpt_login) WHERE cpt_login='" . $u . "';";
        $resultat = $this->db->query($sql);
        if ($resultat->getNumRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Requête qui récupère les informations principales d'un administrateur grâce à son login entré en paramètre pour l'affichage de son profil 
    public function get_info_admin($u)
    {
        $sql = "SELECT cpt_login, cpt_nom, cpt_prenom, cpt_etat FROM t_compte_cpt JOIN t_administrateur_adm USING (cpt_login) WHERE cpt_login='" . $u . "';";
        $resultat = $this->db->query($sql);
        return $resultat->getRow();
    }

    // Requête qui récupère les informations principales d'un membre du jury grâce à son login entré en paramètre pour l'affichage de son profil
    public function get_info_jury($u)
    {
        $sql = "SELECT cpt_login, cpt_nom, cpt_prenom, cpt_etat, jur_discipline, jur_biographie, jur_url  FROM t_compte_cpt JOIN t_compteJury_jur USING (cpt_login) WHERE cpt_login='" . $u . "';";
        $resultat = $this->db->query($sql);
        return $resultat->getRow();
    }

    // Requête qui récupère les informations principales d'un titulaire d'un compre grâce à son login entré en paramètre pour pré-remplir le formulaire de modification de son profil
    public function get_info_perso($u)
    {
        $sql = "SELECT cpt_login, cpt_nom, cpt_prenom FROM t_compte_cpt WHERE cpt_login='" . $u . "';";
        $resultat = $this->db->query($sql);
        return $resultat->getRow();
    }

    //(inutilisé pour le moment) Fonction qui concatène tous les membres des jurys en les mettant à chaque fois à la ligne
    public function get_jury()
    {
        $resultat = $this->db->query("SELECT GROUP_CONCAT(CONCAT(cpt_nom, ' ', cpt_prenom) SEPARATOR '<br />') AS Name FROM t_compte_cpt JOIN t_compteJury_jur USING (cpt_login); ");
        return $resultat->getRow();
    }

    // Fonction qui modifie le profil d'un utilisateur à l'aide de son login et des nouvelles valeurs obtenues dans le formulaire
    public function edit_profil($saisie, $login)
    {
        $mdp = htmlspecialchars(addslashes($saisie['mdp']));
        $sql = "UPDATE t_compte_cpt SET cpt_mdp='" . $mdp . "' WHERE cpt_login='" . $login . "';";
        return $this->db->query($sql);
    }

    /*==============================================================
        FONCTION DES CONCOURS
    ==============================================================*/

    // Fonction qui récupère tous les concours sans les catégories et les membres du jury
    public function get_all_concours()
    {
        $requete = "SELECT con_nom, con_description, con_discipline, con_image, t_concours_con.cpt_login AS Organisateur, phase_concours(con_id) 
        AS phase, con_date_debut, con_tps_candidature, con_tps_preselect, con_tps_finale FROM t_concours_con ORDER BY phase;";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // Fonction pour modifier les informations du carousel
    public function get_all_concours_menu()
    {
        $requete = "SELECT con_nom, con_description, cpt_login, phase_concours(con_id) AS phase FROM t_concours_con ORDER BY con_date_debut DESC LIMIT 5;";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // - Requête récupérant toutes les données de tous les concours de la plateforme (passés, en cours, à venir) avec leurs principales caractéristiques

    public function get_all_concours_V2()
    {
        $requete = "SELECT DISTINCT con_id, con_nom, con_description, con_discipline, donner_categorie(con_id) AS categorie, t_concours_con.cpt_login 
        AS organisateur, phase_concours(con_id) AS phase, donner_toutes_dates(con_id) AS all_date, donner_membre_jury(con_id) AS jury FROM t_concours_con 
        LEFT JOIN t_liaison_lia USING (con_id) 
        LEFT JOIN t_compteJury_jur ON (t_compteJury_jur.cpt_login=t_liaison_lia.cpt_login) 
        LEFT JOIN t_compte_cpt ON (t_compte_cpt.cpt_login=t_compteJury_jur.cpt_login)
        LEFT JOIN t_partionne_par USING (con_id) 
        LEFT JOIN t_categorie_cat USING (cat_id);";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // Fonction qui récupère tous les informations d'un courncours ainsi que les catégories et les membres du jury grâce son ID
    public function get_concours_by_id($ID)
    {
        $requete = "SELECT DISTINCT con_nom, con_description, con_discipline, con_image, donner_categorie(con_id) AS categorie, t_concours_con.cpt_login AS organisateur, phase_concours(con_id) AS phase, donner_toutes_dates2(con_id) AS all_date FROM t_concours_con 
        LEFT JOIN t_liaison_lia USING (con_id) 
        LEFT JOIN t_compteJury_jur ON (t_compteJury_jur.cpt_login=t_liaison_lia.cpt_login) 
        LEFT JOIN t_compte_cpt ON (t_compte_cpt.cpt_login=t_compteJury_jur.cpt_login)
        LEFT JOIN t_partionne_par USING (con_id) 
        LEFT JOIN t_categorie_cat USING (cat_id)
        WHERE con_id='" . $ID . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    } 

    // Fonction qui récupère tous les informations d'un courncours ainsi que les catégories et les membres du jury grâce son ID pour l'affichage des membres du jury dans les détails complets d'un concours
    public function get_jury_concours_by_id($ID)
    {
        $requete = "SELECT cpt_nom, cpt_prenom, jur_discipline, jur_url FROM t_compteJury_jur
        JOIN t_compte_cpt USING (cpt_login) 
        LEFT JOIN t_liaison_lia ON (t_liaison_lia.cpt_login = t_compteJury_jur.cpt_login) 
        LEFT JOIN t_concours_con USING (con_id) 
        WHERE con_id ='" . $ID . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // Fonction qui récupère tous les concours avec les catégories et les membres du jury

    public function get_all_concours_admin()
    {
        $requete = "SELECT * FROM CONCOURS;";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // Fonction qui récupère tous les concours avec les catégories et les membres du jury

    public function get_all_concours_jury($j)
    {
        $requete = " SELECT * FROM CONCOURS WHERE jury LIKE CONCAT('%', (SELECT name_jury('" . $j . "')), '%'); ";
        // 
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // fonctions qui récupérer les informations pour l'affichage des candidats inscripts pour la
    // sélection à l'aide de l'id du concours (3 fonctions suivante). 

    // récupère les candidatures
    public function get_all_candidats($id)
    {
        $requete = "SELECT can_id, can_nom, can_prenom, can_email, can_presentation, can_date, can_etat, cat_nom 
        FROM t_candidature_can JOIN t_categorie_cat USING (cat_id) WHERE con_id='" . $id . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // récupère les ressources
    public function get_all_ressources_candidats($id)
    {
        $requete = "SELECT res_nom, res_description, res_type, can_id FROM t_ressource_res 
        JOIN t_candidature_can USING (can_id) WHERE con_id='" . $id . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // récupère les catégories
    public function get_all_categorie_candidats($id)
    {
        $requete = "SELECT DISTINCT cat_nom FROM t_categorie_cat 
        JOIN t_candidature_can USING (cat_id) WHERE con_id='" . $id . "';";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    // Fonction qui ajoute un nouveau concours à la base de donnée à l'aide des valeurs fournies en paramètres et du login de l'administrateur connecté
    public function set_concours($saisie, $login){
        $nom = htmlspecialchars(addslashes($saisie['nom']));
        $description = htmlspecialchars(addslashes($saisie['description']));
        $date = htmlspecialchars(addslashes($saisie['date_debut']));
        $tps_inscription = htmlspecialchars(addslashes($saisie['tps_candidature']));
        $tps_preselect = htmlspecialchars(addslashes($saisie['tps_preselection']));
        $tps_finale = htmlspecialchars(addslashes($saisie['tps_finale']));
        $discipline = htmlspecialchars(addslashes($saisie['discipline']));

        $sql = "INSERT INTO t_concours_con VALUES(null, '" . $nom . "','" . $description . "', '6 avenue LeGorgeu Brest', 'image_concours_paysage25.jpg',
         '" . $date . "','" . $tps_inscription . "','" . $tps_preselect . "','" . $tps_finale . "','" . $discipline . "','" . $login . "');";
        return $this->db->query($sql);
    }

    // Fonction qui appelle la procédure qui supprimer un concours.
    public function supprimer_concours($id_concours)
    {
        return $this->db->query("CALL supprimer_concours(" . htmlspecialchars(addslashes($id_concours)) . ");");
    }
}
