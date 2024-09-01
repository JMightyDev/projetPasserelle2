<?php
    ob_start();
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
            <form method="post" action="<?= BASE_URL ?>article/<?= $article['id'] ?>/edit">
        <?php } else { ?>
            <h1 class="text-dark my-4">Ajouter le projet</h1>
            <form method="post" action="<?= BASE_URL ?>newArticle">
        <?php } ?>
            <div class="mb-3">
                <label for="title" class="form-label">Titre de l'article</label>
                <?php if (isset($article)) { ?>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="articleTitle" required value="<?= $article['title'] ?>">
                <?php } else { ?>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="articleTitle" required>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="subtitle" class="form-label">Courte description</label>
                <?php if (isset($article)) { ?>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" aria-describedby="articleSubTitle" required value="<?= $article['subtitle'] ?>">
                <?php } else { ?>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" aria-describedby="articleSubTitle" required>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="cover">Image de couverture (URL)</label>
                <?php if (isset($article)) { ?>
                    <input type="text" class="form-control" id="cover" name="cover" aria-describedby="coverUrl" required value="<?= $article['cover'] ?>">
                <?php } else { ?>
                    <input type="text" class="form-control" id="cover" name="cover" aria-describedby="coverUrl" required>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="content">Contenu</label>
                <?php if (isset($article)) { ?>
                    <textarea class="form-control" id="content" name="content" rows="5" required><?= $article['content'] ?></textarea>
                <?php } else { ?>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                <?php } ?>  
            </div>
            <?php if (isset($editMode)) { ?>
                <button type="submit" class="btn btn-perso1">Modifier l'article</button>
            <?php } else { ?>
                <button type="submit" class="btn btn-perso1">Ajouter l'article</button>
            <?php } ?>
        </form>
    </section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>
