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
        <?php if (isset($editMode)) { ?>
            <h1 class="text-dark my-4">Modifier le projet</h1>
            <form method="post" action="<?= $path ?>project/<?= $project['id'] ?>/edit">
        <?php } else { ?>
            <h1 class="text-dark my-4">Ajouter le projet</h1>
            <form method="post" action="<?= $path ?>newProject">
        <?php } ?>
            <div class="mb-3">
                <label for="title" class="form-label">Titre du projet</label>
                <?php if (isset($project)) { ?>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="projectTitle" required value="<?= $project['title'] ?>">
                <?php } else { ?>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="projectTitle" required>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="subtitle" class="form-label">Courte description</label>
                <?php if (isset($project)) { ?>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" aria-describedby="projectSubTitle" required value="<?= $project['subtitle'] ?>">
                <?php } else { ?>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" aria-describedby="projectSubTitle" required>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="cover">Image de couverture (URL)</label>
                <?php if (isset($project)) { ?>
                    <input type="text" class="form-control" id="cover" name="cover" aria-describedby="coverUrl" required value="<?= $project['cover'] ?>">
                <?php } else { ?>
                    <input type="text" class="form-control" id="cover" name="cover" aria-describedby="coverUrl" required>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="content">Contenu</label>
                <?php if (isset($project)) { ?>
                    <textarea class="form-control" id="content" name="content" rows="5" required><?= $project['content'] ?></textarea>
                <?php } else { ?>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                <?php } ?>    
            </div>
            <?php if (isset($editMode)) { ?>
                <button type="submit" class="btn btn-perso1">Modifier le projet</button>
            <?php } else { ?>
                <button type="submit" class="btn btn-perso1">Ajouter le projet</button>
            <?php } ?>
        </form>
    </section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>
