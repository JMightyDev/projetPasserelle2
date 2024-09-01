<?php
//Routeur

// Fonction pour charger le fichier .env (fichier à créer)
function chargerFichierEnv() {
    
    $cheminFichierEnv = '.env'; // Par défaut à la racine du projet

    if (file_exists($cheminFichierEnv)) {
        $lignes = file($cheminFichierEnv);
        foreach ($lignes as $ligne) {
            // Ignorer les lignes vides et les commentaires
            if (trim($ligne) === '' || strpos(trim($ligne), '#') === 0) {
                continue;
            }

            // Séparer le nom et la valeur
            list($nom, $valeur) = explode('=', $ligne, 2);

            // Créer la variable d'environnement
            putenv($nom . '=' . trim($valeur));
        }
    } else {
        echo "Fichier .env introuvable.";
        exit();
    }
}

chargerFichierEnv();
session_start();

function url(){
    return sprintf(
      "%s://%s%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME'],
      $_SERVER['REQUEST_URI']
    );
}

define('BASE_URL', url()); // Permet de connaitre le chemin vers la base du site, peu importe l'environnement test / prod / localhost / domaine etc

require('controller/controller.php');

try {

    if (isset($_COOKIE['autoconnect']) && !isset($_SESSION['connect'])) {
        $secret = htmlspecialchars($_COOKIE['autoconnect']);
        autoConnect($secret);
    }

    if (isset($_GET['page'])) {

        $page = htmlspecialchars($_GET['page']);

        if ($page == 'home' || $page == '' || $page == 'articles') {
            home();
        } else if ($page == 'projects') {
            getProjects();
        } else if ($page == 'article' && !empty($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            if (!empty($_GET['action'])) {
                $action = htmlspecialchars($_GET['action']);
                if ($action == "delete") {
                    deleteArticle($id);
                } else if ($action == "edit") {
                    editArticle($id);
                } else if ($action == "addComment") {
                    addComment($id, 1); //type 1 => Article
                } else {
                    throw new Exception("Impossible d'effectuer cette action.");
                }
            } else {
                getArticle($id);
            }
        } else if ($page == 'project' && !empty($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            if (!empty($_GET['action'])) {
                $action = htmlspecialchars($_GET['action']);
                if ($action == "delete") {
                    deleteProject($id);
                } else if ($action == "edit") {
                    editProject($id);
                } else if ($action == "addComment") {
                    addComment($id, 2); //type 2 => Projet
                } else {
                    throw new Exception("Impossible d'effectuer cette action.");
                }
            } else {
                getProject($id);
            }
        } else if ($page == 'logout') {
            logout();
        } else if ($page == 'login') {
            login();
        } else if ($page == 'subscribe') {
            subscribe();
        } else if ($page == 'newArticle') {
            newArticle();
        } else if ($page == 'newProject') {
            newProject();
        } else {
            throw new Exception("Cette page n'existe pas.");
        }
    } else {
        home();
    }
} catch (Exception $e) {
    //die('Erreur : '.$e->getMessage());
    $error = $e->getMessage();
    require('view/errorView.php');
}