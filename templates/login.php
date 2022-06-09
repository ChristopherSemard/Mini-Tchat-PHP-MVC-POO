<?php $title = "Connexion"; ?>

<?php ob_start(); ?>

        <h2 class="text-center mb-4">CONNEXION</h2>
        <form class="container d-flex flex-column gap-3" method="POST" action="../index.php?action=submitlogin">
                <label for="inputPseudo">Pseudo</label>
                <input type="text" class="form-control" id="inputPseudo" name="pseudo" placeholder="Pseudo" required value="<?= isset($_SESSION['ERROR_LOGIN_INPUT']) ? $_SESSION['ERROR_LOGIN_INPUT']['pseudo'] : '' ?>">
                <label for="inputPassword">Mot de passe</label>
                <input type="password" class="form-control" id="inputPassword" name="password"  placeholder="Mot de passe" required>
            <button type="submit" class="btn btn-primary">Valider</button>

            <?php if (isset($_SESSION['ERROR_LOGIN'])): ?>
            <p class='text-center alert alert-danger mt-2' role='alert'><?= $_SESSION['ERROR_LOGIN'] ?></p>
            <?php endif ?>
            
            <a href="../index.php?action=signin" class="text-center">Pas encore de compte ? Inscrivez vous !</a>
        </form>

        <?php $content = ob_get_clean(); ?>


<?php require('layout.php') ?>
