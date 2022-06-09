<?php $title = "Inscription"; ?>

<?php ob_start(); ?>


    <h2 class="text-center mb-4">INSCRIPTION</h2>
    <form class="container  d-flex flex-column gap-3" method="POST" action="./submit-inscription.php">
        <!-- Choix de pseudo -->
        <div class="form-group">
            <label for="inputPseudo">Pseudo</label>
            <input type="text" class="form-control" id="inputPseudo" name="pseudo" placeholder="Pseudo" required>
        </div>
        <!-- Choix de mot de passe -->
        <div class="form-group">
            <label for="inputPassword">Mot de passe (8 caractères minimum)</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Mot de passe" required>
        </div>
        <!-- Confirmation mot de passe -->
        <div class="form-group">
            <label for="inputConfirmPassword">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="inputConfirmPassword" name="password-confirm" placeholder="Mot de passe" required>
        </div>
        <!-- Choix de couleur -->
        <div class="form-group d-flex align-items-center justify-content-between">
            <label for="inputColor">Couleur du pseudo</label>
            <input type="color"  id="inputColor" name="color" value="#ffdd00">
        </div>
        <!-- Bouton envoyer -->
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>



<?php $content = ob_get_clean(); ?>


<?php require('layout.php') ?>
