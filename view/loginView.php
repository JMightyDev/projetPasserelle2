<?php
    ob_start();
?>
   <section class="container">
        <div class="row d-flex justify-content-center my-5 mx-1 col-lg-8 bg-perso1 p-4 rounded text-light">
            <form action="login" method="POST">
                <h1 class="mb-4">Connexion</h1>
                <div class="form-floating mb-3 text-dark">
                    <input type="email" class="form-control" id="email" name="email" placeholder="nom@exemple.fr">
                    <label label for="email">Addresse email</label>
                </div>
                <div class="form-floating mb-3 text-dark">
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Mot de passe">
                    <label for="pwd">Mot de passe</label>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="autoconnect" name="autoconnect">
                    <label class="form-check-label" for="autoconnect">Rester connecté</label>
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Se connecter</button>
                <a href="subscribe" class="btn btn-lg btn-perso2 ms-5">Créer un compte</a>
            </form>
        </div>
    </section>
<?php
    $content = ob_get_clean();
    require('base.php');
?>