<?php

   require_once('model/ArticleManager.php');
   require_once('model/LoginManager.php');
   require_once('model/SubscribeManager.php');
   require_once('model/User.php');
   require_once('model/Security.php');
   require_once('model/Verify.php');

   function autoConnect($secret) {
      $loginManager = new LoginManager();
      $loginManager->autoConnect($secret);
   }

   function home() {
      $title = "Accueil";
      $onglet = "articles";
      $articleManager = new ArticleManager;
      $articles = $articleManager->getArticles();
      
      require('view/articlesView.php');
   }

   function getArticle($id) {
      $title = "Article";
      $onglet = "articles";
      $articleManager = new ArticleManager;
      $article = $articleManager->getArticle($id);
      $comments = $articleManager->getComments($id);
      if ($article === false) {
         throw new Exception("Impossible d'afficher l'article pour le moment.");
      }
      if ($comments === false) {
         throw new Exception("Impossible d'afficher les commentaires pour le moment.");
      }

      require('view/articleView.php');
   }

   function deleteArticle($id) {
      $title = "Article";
      $onglet = "articles";
      $articleManager = new ArticleManager;

      if (!$articleManager->getArticle($id)) {
         $error = 1;
         $message = "Cet article n'existe pas.";
         $articles = $articleManager->getArticles();
         require('view/articlesView.php');
         exit();
      }
      
      if (empty($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
         throw new Exception("Vous n'avez pas l'autorisation de faire ça.");
      }

      $res = $articleManager->deleteComments($id);

      if ($res === false) {
         throw new Exception("Impossible de supprimer les commentaires de cet article pour le moment.");
      }

      $res = $articleManager->deleteArticle($id);

      if ($res === false) {
         throw new Exception("Impossible de supprimer cet article pour le moment.");
      }

      $success = 1;
      $message = "Article supprimé.";

      $articles = $articleManager->getArticles();
      
      require('view/articlesView.php');
   }

   function getProject($id) {
      $title = "Project";
      $onglet = "projects";
      $articleManager = new ArticleManager;
      $project = $articleManager->getProject($id);
      $comments = $articleManager->getComments($id);

      if ($project === false) {
         throw new Exception("Impossible d'afficher le projet pour le moment.");
      }

      if ($comments === false) {
         throw new Exception("Impossible d'afficher les commentaires pour le moment.");
      }

      require('view/projectView.php');
   }

   function editProject($id) {
      $title = "Modifier le projet";
      $onglet = "projects";
      $articleManager = new ArticleManager;
      $editMode = true;

      if (!empty($_POST['title'])) {
         
         $titleProject = htmlspecialchars($_POST['title']);

         if (!empty($_POST['subtitle'])) {
            $subtitle = htmlspecialchars($_POST['subtitle']);
         }
         if (!empty($_POST['cover'])) {
            $cover = htmlspecialchars($_POST['cover']);
         }
         if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
         }

         if (!isset($_SESSION['userId']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
            throw new Exception("Vous n'avez pas les autorisations nécessaires pour effectuer cette action.");
            exit();
         }
         
         $res = $articleManager->updateProject($titleProject, $subtitle, $cover, $content, $id);

         if ($res) {
            $success = 1;
            $message = "Le projet a été mis à jour.";

            $project = $articleManager->getProject($id);
            $comments = $articleManager->getComments($id);

            if ($project === false) {
               throw new Exception("Impossible d'afficher le projet pour le moment.");
            }

            if ($comments === false) {
               throw new Exception("Impossible d'afficher les commentaires pour le moment.");
            }

            require('view/projectView.php');

         } else {
            $error = 1;
            $message = "Impossible de mettre à jour le projet.";
         }

      } else {
         $project = $articleManager->getProject($id);
         require('view/newProjectView.php');
      }      
   }

   function editArticle($id) {
      $title = "Modifier l'article";
      $onglet = "articles";
      $articleManager = new ArticleManager;
      $editMode = true;

      if (!empty($_POST['title'])) {
         
         $titleArticle = htmlspecialchars($_POST['title']);

         if (!empty($_POST['subtitle'])) {
            $subtitle = htmlspecialchars($_POST['subtitle']);
         }
         if (!empty($_POST['cover'])) {
            $cover = htmlspecialchars($_POST['cover']);
         }
         if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
         }

         if (!isset($_SESSION['userId']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
            throw new Exception("Vous n'avez pas les autorisations nécessaires pour effectuer cette action.");
            exit();
         }
         
         $res = $articleManager->updateArticle($titleArticle, $subtitle, $cover, $content, $id);

         if ($res) {
            $success = 1;
            $message = "L'article a été mis à jour.";
            $article = $articleManager->getArticle($id);
            $comments = $articleManager->getComments($id);
            if ($article === false) {
               throw new Exception("Impossible d'afficher l'article pour le moment.");
            }
            if ($comments === false) {
               throw new Exception("Impossible d'afficher les commentaires pour le moment.");
            }

            require('view/articleView.php');
         } else {
            $error = 1;
            $message = "Impossible de mettre à jour l'article.";
         }
      } else {
         $article = $articleManager->getArticle($id);

         require('view/newArticleView.php');
      }
   }

   function deleteProject($id) {
      $title = "Project";
      $onglet = "projects";
      $articleManager = new ArticleManager;

      if (!$articleManager->getProject($id)) {
         $error = 1;
         $message = "Ce projet n'existe pas.";
         $projects = $articleManager->getProjects();

         require('view/projectsView.php');
         exit();
      }
      
      if (empty($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
         throw new Exception("Vous n'avez pas l'autorisation de faire ça.");
      }

      $res = $articleManager->deleteComments($id);

      if ($res == false) {
         throw new Exception("Impossible de supprimer les commentaires de ce projet");
      }

      $res = $articleManager->deleteProject($id);

      if ($res == false) {
         throw new Exception("Impossible de supprimer ce projet pour le moment.");
      }

      $success = 1;
      $message = "Projet supprimé.";

      $projects = $articleManager->getProjects();
      
      require('view/projectsView.php');
   }

   function logout() {
      $_SESSION = array();
      unset($_COOKIE['autoconnect']); 
      setcookie('autoconnect', '', -1, '/');
      session_destroy();
      $path = dirname($_SERVER['PHP_SELF']) . "/";
      header("location: .$path");
      exit();
   }

   function login() {
      $title = "Connexion";
      $onglet = "";
      $loginManager = new LoginManager;
      if (isset($_COOKIE['autoconnect']) && !isset($_SESSION['connect'])) {
         $secret = htmlspecialchars($_COOKIE['autoconnect']);
         if ($loginManager->autoconnect($secret)) {
            home(); //User déjà connecté (cookie autoconnect détecté)
         } else {
            $error = true;

            require('view/loginView.php');
         }
      } else {
         if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
            
            $email   = htmlspecialchars($_POST['email']);
            $pwd     = Security::encrypt(htmlspecialchars($_POST['pwd']));

            if ($loginManager->connect($email, $pwd)) {
               $error = false;
               home();
            } else {
               $error = true;

               require('view/loginView.php');
            }
         } else {
            $error = false;

            require('view/loginView.php');
         }
      }
   }

   function subscribe() {
      $title = "Inscription";
      $onglet = "";
      $error   = 0;
      $message = "";
      $success = 0;

      if (!empty($_POST['email']) && !empty($_POST['pwd']) && !empty($_POST['pwd2']) && !empty($_POST['username'])) {
         
         $subscribeManager = new SubscribeManager;

         $email      = htmlspecialchars($_POST['email']);
         $pwd        = htmlspecialchars($_POST['pwd']);
         $pwd2       = htmlspecialchars($_POST['pwd2']);
         $username   = htmlspecialchars($_POST['username']);

         if ($pwd <> $pwd2) {
            $error = 1;
            $message = "Les mots de passe ne correspondent pas.";

            require('view/subscribeView.php');
            exit();
         }

         if (!Verify::isValidEmail($email)) {
            $error = 1;
            $message = "Cette adresse email est invalide.";

            require('view/subscribeView.php');
            exit();
         }

         $user = new User($email, $pwd, $username);
         
         if ($subscribeManager->emailExist($email)) {
            $error = 1;
            $message = "Ce compte existe déjà.";

            require('view/subscribeView.php');
            exit();
         }

         $subscribeManager->save($user);

         $subscribeManager->createSessions($user);

         $success = 1;
      }

      require('view/subscribeView.php');
   }

   function getProjects() {
      $title = "Projets";
      $onglet = "projects";

      $articleManager = new ArticleManager;
      $projects = $articleManager->getProjects();

      if ($projects === false) {
         throw new Exception("Impossible d'afficher les projets pour le moment.");
      }

      require('view/projectsView.php');
   }

   //Fonction commune aux articles et projets, le type sert à retourner à la page correspondante
   function addComment($id, $type) {

      $error = 0;
      $articleManager = new ArticleManager;

      if ($type == 1) {
         $title = "Article";
         $onglet = "articles";
         $article = $articleManager->getArticle($id);
      } else {
         $title = "Projet";
         $onglet = "articles";
         $project = $articleManager->getProject($id);
      }

      if (empty($_POST['content'])) {
         $error = 1;
         $message = "Le commentaire est vide.";
      }

      if (!isset($_SESSION['userId'])) {
         $error = 1;
         $message = "Vous n'êtes pas connecté.";
      } else {
         $userId = htmlspecialchars($_SESSION['userId']);
      }

      if ($error == 0) {
         $content = htmlspecialchars($_POST['content']);

         $res = $articleManager->addComment($content, $userId, $id);

         if ($res) {
            $success = 1;
            $message = "Le commentaire a été ajouté.";
         } else {
            $error = 1;
            $message = "Erreur lors de l'ajout du commentaire.";
         }
      }
         
      $comments = $articleManager->getComments($id);
         
      if ($comments === false) {
         $error = 1;
         $message .= "Impossible d'afficher les commentaires pour le moment.";
      }
      
      if ($type == 1) {
         require('view/articleView.php');
      } else {
         require('view/projectView.php');
      }

   }

   function newArticle() {
      $title = "Ajouter un article";
      $onglet = "articles";
      $success = 0;
      $error = 0;
      $message = "";

      if (!empty($_POST['title'])) {
         
         $articleManager = new ArticleManager;

         $title = htmlspecialchars($_POST['title']);

         if (!empty($_POST['subtitle'])) {
            $subtitle = htmlspecialchars($_POST['subtitle']);
         }
         if (!empty($_POST['cover'])) {
            $cover = htmlspecialchars($_POST['cover']);
         }
         if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
         }

         if (!isset($_SESSION['userId']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
            throw new Exception("Vous n'avez pas les autorisations nécessaires pour effectuer cette action.");
            exit();
         }
         
         $userId = htmlspecialchars($_SESSION['userId']);

         $res = $articleManager->addArticle($title, $subtitle, $cover, $content, $userId);

         if ($res) {
            $success = 1;
            $message = "L'article a été ajouté.";
         } else {
            $error = 1;
            $message = "Veuillez remplir tous les champs obligatoires.";
         }
      }

      require('view/newArticleView.php');
   }

   function newProject() {
      $title = "Ajouter un projet";
      $onglet = "projects";

      $success = 0;
      $error = 0;
      $message = "";

      if (!empty($_POST['title'])) {
         
         $articleManager = new ArticleManager;

         $title = htmlspecialchars($_POST['title']);

         if (!empty($_POST['subtitle'])) {
            $subtitle = htmlspecialchars($_POST['subtitle']);
         }
         if (!empty($_POST['cover'])) {
            $cover = htmlspecialchars($_POST['cover']);
         }
         if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
         }

         if (!isset($_SESSION['userId']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
            throw new Exception("Vous n'avez pas les autorisations nécessaires pour effectuer cette action.");
            exit();
         }
         
         $userId = htmlspecialchars($_SESSION['userId']);

         $res = $articleManager->addProject($title, $subtitle, $cover, $content, $userId);

         if ($res) {
            $success = 1;
            $message = "Le projet a été ajouté.";
         } else {
            $error = 1;
            $message = "Veuillez remplir tous les champs obligatoires.";
         }
      }

      require('view/newProjectView.php');
   }