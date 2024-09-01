<?php
    $path = $_SERVER['SERVER_NAME']."/";
?>
<!DOCTYPE html>
<html lang="fr" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Knight's Corner - The place white knights developpers discuss">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?> | JMighty</title>
        <link rel="stylesheet" href="<?= $path ?>public/design/default.css"/>
        <link rel="shortcut icon" type="image/png" href="<?= $path ?>public/assets/favicon.png">
    </head>

    <body class="bg-secondary pt-5 d-flex flex-column h-100">
        <header>
            <nav class="navbar navbar-expand-lg bg-perso1 fixed-top" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= $path ?>./">Knight's Corner</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <?php if ($onglet == "articles") { ?>
                                    <a class="nav-link active" aria-current="page" href="<?= $path ?>articles">Articles</a>
                                <?php } else { ?>
                                    <a class="nav-link" href="<?= $path ?>articles">Articles</a>
                                <?php } ?>
                            </li>
                            <li class="nav-item">
                                <?php if ($onglet == "projects") { ?>
                                    <a class="nav-link active" aria-current="page" href="<?= $path ?>projects">Projets</a>
                                <?php } else { ?>
                                    <a class="nav-link" href="<?= $path ?>projects">Projets</a>
                                <?php } ?>
                            </li>
                        </ul>
                        <ul class="navbar-nav d-flex">
                            <?php if (isset($_SESSION['username'])) { ?>
                                <span class="navbar-text me-5">Bienvenue <?= htmlspecialchars($_SESSION['username']); ?> !</span>
                                <li class="nav-item">
                                    <a href="<?= $path ?>logout" class="nav-link">Se déconnecter</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a href="<?= $path ?>login" class="nav-link">Se connecter</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="flex-shrink-0 mb-4">
            <?= $content ?>
        </main>
        <hr class="hr mt-auto mb-0 mx-5">
        <footer class="footer py-3">
            <div class="container">
                <span class="text-perso1">© JMighty 2024</span>
            </div>
        </footer>
        <script src="<?= $path ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>