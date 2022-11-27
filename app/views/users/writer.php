<main class="container-fluid position-relative m-0 p-0 gap-0">
    <?php if(isset($message) && !empty($message)): ?>
            <div id="fading-alert" class="alert alert-info shadow position-absolute top-10 start-50 translate-middle upper-z-index">
                <p class="text-center fw-bold fs-5"><?= $message ?></p>
            </div>
        <?php endif ?>
<section class="mt-5 row justify-content-center align-items-start">
    <article class="col-sm-5 col-12 container-fluid d-flex align-items-start justify-content-center">
        <form action="/register_post" method="POST">
            <section class="shadow p-5 bg-light">
                <div class="mb-3">
                    <label class="form-label" for="title">Titre du post: <span>*</span> :</label>
                    <input class="form-control"  id="title" type="text" name="title" maxlength="250" value="Pas de titre">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="content">Texte du post: <span>*</span> :</label>
                    <textarea class="form-control" id="content" name="content" value="pas de content"  cols="60" rows="10" placeholder="Entrez votre texte" onfocus="this.onfocus=null;" maxlength="950" value="" required ></textarea>
                </div>

                <input id="prodId" name="userId" type="hidden" value="<?= $_SESSION['userId']?>" >
                <input id="post_author" name="post_author" type="hidden" value="<?= $_SESSION['user']?>" >


                <div class="mb-3">
                    <label class="form-label" for="image">Votre photo (copier un lien depuis internet) <span>*</span> :</label>
                    <input  class="form-control" type="url" name="image" id="image"
                            placeholder="https://example.com" pattern="https://.*" size="30"
                            value="https://images.pexels.com/photos/12704642/pexels-photo-12704642.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            required>
                </div>

                <div class="mb-3 mt-2">
                    <select class="form-select mt-1" name="article_status" aria-label="select inputs">
                        <option selected value="1">article public</option>
                        <option value="2">article privé</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input class="btn btn-primary btn-lg" type="submit" value="Enregistrer l'article" name="register_article">
                </div>
            </section>
        </form>
    </article>

    <article class="col-sm-5 col-12 container d-flex flex-column align-items-start justify-content-start">
        <h2 class="mt-2 mb-1"> Articles présent sur le blog: </h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id du Post</th>
                <th scope="col">Auteur</th>
                <th scope="col">Titre du post</th>
                <th scope="col">Lire</th>
                <?php if($_SESSION['userStatus'] === 'admin') { ?>
                <th scope="col">Suppression</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach($posts as $a_post): ?>
                <tr>
                    <th scope="row"><?php echo $a_post->getIdpost() ?></th>
                    <td><?= $a_post->getAuthor_name() ?></td>
                    <td><?php echo $a_post->getTitle() ?></td>
                    <td><a href='/read?post_id=<?php echo $a_post->getIdpost() ?>'>Consulter ce post </a></td>
                    <?php if($_SESSION['userStatus'] === 'admin') { ?>
                        <td><a href='/deletepost?post_id=<?php echo $a_post->getIdpost() ?>'>Supprimer ce post</a></td>
                    <?php } ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </article>
</section>
</main>