<?php
    ob_start();
    $path = dirname($_SERVER['PHP_SELF']) . "/";
?>
    <section class="container">
        <?php
            if (isset($success) && $success == 1 && !empty($message)) {
                echo "<div class='alert alert-success my-4'>$message</div>";
            } else if (isset($error) && $error == 1 && !empty($message)) {
                echo "<div class='alert alert-danger my-4'>$message</div>";
            }
        ?>
        <?php if (isset($projects)) { ?>
            <h1 class='text-dark my-4'>Mes projets</h1>
            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) { ?>
                <a class="btn btn-perso1 mb-4" href="newProject"><i class="bi bi-plus-lg"></i> Ajouter un projet</a>
            <?php } ?>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php
                    while($project = $projects->fetch()) {
                ?>
                    <div class="col">
                        <div class="card">
                            <img src="<?= $project['cover'] ?>" height="400" class="card-img-top" alt="<?= $project['title'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $project['title'] ?></h5>
                                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                            </div>
                            <a href="<?= $path ?>project/<?= $project['id']; ?>" class="stretched-link text-decoration-none"></a>
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