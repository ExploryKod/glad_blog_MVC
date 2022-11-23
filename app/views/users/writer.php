<h1>Writer</h1>
<?php

if(isset($myPost)) {
    var_dump($myPost);
}
?>
<section class="mt-5 row">

    <article class="col-sm-6 container-fluid d-flex align-items-start justify-content-center">
        <form action="/register_post" method="POST">
            <section class="shadow p-5 bg-light">
                <div class="mb-3">
                    <label class="form-label" for="title">Titre du post: <span>*</span> :</label>
                    <input class="form-control"  id="title" type="text" name="title" maxlength="250" required >
                </div>

                <div class="mb-3">
                    <label class="form-label" for="content">Texte du post: <span>*</span> :</label>
                    <textarea class="form-control" id="content" name="content"  cols="30" rows="4" placeholder="Entrez votre texte" onfocus="this.onfocus=null;" maxlength="950" required ></textarea>
                </div>

                <div class="mb-3">
                    <input class="btn btn-primary btn-lg" type="submit" value="Enregistrer l'article" name="register_article">
                </div>
            </section>
        </form>
    </article>

    <article class="col-sm-6 container d-flex flex-column align-items-start justify-content-start">
       <?php
       if(isset($_GET['success']) && $_GET['success'] === 'newarticle') {
           echo "<div class='alert-success'>
                      <p>Votre article est bien publié</p>
                 </div>";
       }

       ?>

        <?php
        $your_id = 20;
        if(isset($your_id)) { ?>
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
                <?php
                    foreach($posts as $one_post):
                    if($your_id === $one_post->getAuthor()):
                        ?>
                        <tr>
                            <th scope="row"><?php echo $one_post->getId() ?></th>
                            <th scope="row"><?php echo $one_post->getAuthor() ?></th>
                            <td><?php echo $one_post->getTitle() ?></td>
                            <td><a href='/writer?id=<?php echo $one_post->getId() ?>'>Supprimer ce post </a></td>
                            <td><a href='/writer?id=<?php echo $one_post->getId() ?>'>modifier ce post </a></td>
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
            <?php foreach($posts as $a_post): ?>
                <tr>
                    <th scope="row"><?php echo $a_post->getId() ?></th>
                    <td><?php echo $a_post->getTitle() ?></td>
                    <td><a href='readPost.php?id=<?php echo $a_post->getAuthor() ?>'>Consulter ce post </a></td>
                    <td></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </article>
</section>
