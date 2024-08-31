<?php
    ob_start();
    $path = "." . dirname($_SERVER['PHP_SELF']) . "/";
?>
   <section class="container">
        <?php
            if (isset($success) && $success == 1) {
                echo "<div class='alert alert-success my-4'>$message</div>";
            } else if (isset($error) && $error == 1 && !empty($message)) {
                echo "<div class='alert alert-danger my-4'>$message</div>";
            }
        ?>
        <h1 class="text-dark my-4"><?= $project['title'] ?></h1>
        <div class="col mb-3 col-lg-6">
            <div class="card">
                <img src="<?= $project['cover'] ?>" height="400" class="card-img-top" alt="<?= $title ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $project['subtitle'] ?></h5>
                    <p class="card-text"><?= $project['content'] ?></p>
                </div>
                <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) { ?>
                    <div class="card-footer text-end">
                        <a class="btn btn-warning me-3" href="<?= $path ?>project/<?= $project['id'] ?>/edit"><i class="bi bi-pencil"></i> Modifier</a>
                        <a class="btn btn-danger" href="<?= $path ?>project/<?= $project['id'] ?>/delete"><i class="bi bi-x-lg"></i> Supprimer</a>
                    </div>
                <?php } ?>
            </div>
        </div>
        
        <?php
            if (isset($_SESSION['email'])) {
        ?>
            <form class="mb-4" method="post" action="<?= $path ?>project/<?= $project['id'] ?>/addComment">
                <div class="mb-3 col-lg-6">
                    <label for="content" class="form-label">Commentaire</label>
                    <textarea class="form-control" id="content" rows="2" name="content"></textarea>
                </div>
                <button class="btn btn-perso1" type="submit"><i class="bi bi-plus-lg"></i> Ajouter un commentaire</button>
            </form>
        <?php
            } else {
                echo "<a class='text-decoration-none' href='$path/login'>Connectez-vous</a> pour ajouter des commentaires.";
            }
            while($comment = $comments->fetch()) {
        ?>

            <figure>
                <blockquote class="blockquote">
                    <p><?= $comment['content'] ?></p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    <?= $comment['username'] ?> le <?= date('d-m-Y à H:i:s', strtotime($comment['creation_datetime']));?>
                </figcaption>
            </figure>

        <?php } ?>
    </section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>
