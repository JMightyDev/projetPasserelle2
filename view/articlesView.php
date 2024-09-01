<?php
    ob_start();
?>
    <section class="container">
        <?php
            if (isset($success) && $success == 1 && !empty($message)) {
                echo "<div class='alert alert-success my-4'>$message</div>";
            } else if (isset($error) && $error == 1 && !empty($message)) {
                echo "<div class='alert alert-danger my-4'>$message</div>";
            }
        ?>
        <?php if (isset($articles)) { ?>
            <h1 class='text-dark my-4'>Mes articles</h1>
            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) { ?>
                <a class="btn btn-perso1 mb-4" href="newArticle"><i class="bi bi-plus-lg"></i> Ajouter un article</a>
            <?php } ?>
            <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
                <?php
                    while($article = $articles->fetch()) {
                ?>
                    <div class="col">
                        <div class="card">
                            <img src="<?= $article['cover'] ?>" height="400" class="card-img-top" alt="<?= $article['title'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $article['title'] ?></h5>
                                <p class="card-text"><?= $article['subtitle'] ?></p>
                            </div>
                            <a href="article/<?= $article['id']; ?>" class="stretched-link text-decoration-none"></a>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        <?php } ?>
    </section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>