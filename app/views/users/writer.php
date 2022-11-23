<h1>Writer</h1>

<section class="mt-5 row">

    <article class="col-sm-6 container-fluid d-flex align-items-start justify-content-center">
        <form action="../models/postData.php" method="POST">
            <section class="shadow p-5 bg-light">
                <div class="mb-3">
                    <label class="form-label" for="username">Titre du post: <span>*</span> :</label>
                    <input class="form-control"  id="username" type="text" name="title" maxlength="250" required >
                </div>

                <div class="mb-3">
                    <label class="form-label" for="post">Texte du post: <span>*</span> :</label>
                    <textarea class="form-control" id="post" name="post"  cols="30" rows="4" placeholder="Entrez votre texte" onfocus="this.onfocus=null;" maxlength="950" required ></textarea>
                </div>

                <div class="mb-3">
                    <input class="btn btn-primary btn-lg" type="submit" value="Enregistrer l'article" name="register_article">
                </div>
            </section>
        </form>
    </article>

    <article class="col-sm-6 container d-flex flex-column align-items-start justify-content-start">


        <?php if(isset($your_id) && ($_SESSION['user'] === $your_id)) { ?>
            <h2>Liste de vos articles: </h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID du post:</th>
                    <th scope="col">Votre ID:</th>
                    <th scope="col">Titre du post:</th>
                    <th scope="col">Opération</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($allvalues as $one_post):
                    if($your_id === $one_post['user_id']):
                        ?>

                        <tr>
                            <th scope="row"><?php echo $one_post['id'] ?></th>
                            <th scope="row"><?php echo $one_post['user_id'] ?></th>
                            <td><?php echo $one_post['title'] ?></td>
                            <td><a href='models/delete.php?id=<?php echo $one_post['id'] ?>'>Supprimer ce post </a></td>
                            <td><a href='update_form.php?id=<?php echo $one_post['id'] ?>'>modifier ce post </a></td>
                            <td></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php } else {  ?>

            <div class="alert alert-success mx-auto my-2 w-75">
                <p class="fs-6 fw-bold p-3"> Vous n'avez pas encore créé d'articles. Libérez votre créativité, écrivez un article pour le montrer au monde.</p>
            </div>

        <?php }  ?>

        <h2 class="mt-2">Liste des articles écrit par d'autres talents: </h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titre du post</th>
                <th scope="col">Lire</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($allposts as $a_post): ?>
                <tr>
                    <th scope="row"><?php echo $a_post['id'] ?></th>
                    <td><?php echo $a_post['title'] ?></td>
                    <td><a href='readPost.php?id=<?php echo $a_post['id']?>'>Consulter ce post </a></td>
                    <td></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    </article>

</section>
