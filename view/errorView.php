<?php
    ob_start();
    $title = "Erreur";
    $onglet = "";
?>
    <section class="container">
        <h1 class="my-4">OUPS !</h1>
        <p><?= $error ?></p>
        <a href='<?= BASE_URL ?>home'>Retour</a>
    </section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>