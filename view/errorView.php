<?php
    ob_start();
    $title = "Accueil";
    $path = "." . dirname($_SERVER['PHP_SELF']) . "/";
    $onglet = "";
?>
    <section class="container">
        <h1 class="my-4">OUPS !</h1>
        <p><?= $error ?></p>
        <a href='<?= $path ?>home'>Retour</a>
    </section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>