<?php
    ob_start();
    $path = "." . dirname($_SERVER['PHP_SELF']) . "/";
?>
<section class="container">
    <?php
        if (isset($success) && $success == 1) {
            echo '<div class="alert alert-success col-lg-8 mt-5 mx-1">Inscription réalisée avec succès.</div>';
        } else if(isset($error) && !empty($message)) {
            echo '<div class="alert alert-danger col-lg-8 mt-5 mx-1">'.$message.'</div>';
        }
    ?>
    <?php if (!isset($_SESSION['email'])) { ?>
    <div class="row d-flex justify-content-center my-5 mx-1 col-lg-8 bg-perso1 p-4 rounded">
        <form method="post" action="subscribe">
            <h1 class="text-light mb-4">Inscription</h1>
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="username" id="username" required placeholder="Pseudo">
                <label for="username">Pseudo</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="email" name="email" id="email" required placeholder="Email">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="password" name="pwd" id="pwd" required placeholder="Mot de passe">
                <label for="pwd">Mot de passe</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="password" name="pwd2" id="pwd2" required placeholder="Confirmation">
                <label for="pwd2">Confirmation</label>
            </div>
            <input class="btn btn-lg btn-primary" type="submit" value="Créer un compte">
        </form>
    </div>
    <?php 
        } else {
            echo '<div class="alert alert-info col-lg-8 mt-5 mx-1">Vous êtes connecté. <a href="home">Retour</a></div>';
        }
    ?>
</section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>