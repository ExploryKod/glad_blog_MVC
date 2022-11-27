<?php

?>
<main>
    <?php if(isset($_GET['error'])) { ?>
        <?php if($_GET['error'] === 'alreadylog') {
            ?>
            <div class="container w-50 mt-5 alert alert-info" role="alert">
                Vous avez déjà un compte chez nous: veuillez vous logger ci-dessous.
            </div>
        <?php } ?>

        <?php if($_GET['error'] === 'no-info') {
            ?>
            <div class="container w-50 mt-5 alert alert-info" role="alert">
                Nous n'avons pas de compte enregistré avec ces informations: créez votre compte.
            </div>
        <?php } ?>

        <?php if($_GET['error'] === 'info') { ?>
            <div class="container w-50 mt-5 alert alert-danger" role="alert">
                Vous avez entré un mauvais password ou un mauvais pseudo. Réessayez.
            </div>
        <?php } ?>

        <?php if($_GET['error'] === 'no-session') { ?>
            <div class="container w-50 mt-5 alert alert-danger" role="alert">
                Il y a eu une erreur avec la destruction de votre compte.
            </div>
        <?php } ?>
    <?php } ?>

    <?php if(isset($_GET['login']))  {  ?>
        <?php if($_GET['login'] === 'ok') { ?>
            <div class="container w-50 mt-5 alert alert-success" role="alert">
                Vous êtes bien enregistré chez nous, connectez-vous ici:
            </div>
        <?php } ?>
    <?php } ?>

    <?php if(isset($_GET['drop_user']))  {  ?>
        <?php if($_GET['drop_user'] === 'ok') { ?>
            <div class="container w-50 mt-5 alert alert-success" role="alert">
                Votre compte a été détruit ainsi que tous vos articles.
            </div>
        <?php } ?>
    <?php } ?>

    <section class="container mt-5 d-flex justify-content-center align-item-center">
        <form action="/login" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pseudo: <span>*</span></label>
                <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="text" name="username" maxlength="250" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe: <span>*</span></label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" maxlength="250" required>
            </div>

            <div class="d-flex flex-column ">
                <input class="btn btn-primary" type="submit" value="Valider" name="login">
                <div><p>Pas encore inscris ? <a href="">créer un compte</a></p></div>
            </div>
        </form>
    </section>
</main>
