<main class="page position-relative">
    <?php if(isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= $message ?></p>
        </div>
    <?php endif ?>

    <section class="writer-layout">
        <article>
            <form action="/register_post" method="POST">
                <section class="writer-panel shadow bg-light">
                    <h2 class="fs-4 mb-4">Nouvel article</h2>
                    <div class="mb-3">
                        <label class="form-label" for="title">Titre du post <span>*</span></label>
                        <input class="form-control" id="title" type="text" name="title" maxlength="250" value="Pas de titre">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="content">Texte du post <span>*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="10" placeholder="Entrez votre texte" maxlength="950" required></textarea>
                    </div>

                    <input id="prodId" name="userId" type="hidden" value="<?= htmlspecialchars((string) ($_SESSION['userId'] ?? '')) ?>">
                    <input id="post_author" name="post_author" type="hidden" value="<?= htmlspecialchars((string) ($_SESSION['user'] ?? '')) ?>">

                    <div class="mb-3">
                        <label class="form-label" for="image">Image de l'article (URL ou chemin local) <span>*</span></label>
                        <input class="form-control" type="text" name="image" id="image"
                                placeholder="/public/assets/ordinateur.jpg"
                                value="/public/assets/ordinateur.jpg"
                                required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="article_status">Visibilité</label>
                        <select class="form-select" id="article_status" name="article_status" aria-label="Visibilité de l'article">
                            <option selected value="1">Article public</option>
                            <option value="2">Article privé</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <input class="btn btn-primary btn-lg" type="submit" value="Enregistrer l'article" name="register_article">
                    </div>
                </section>
            </form>
        </article>

        <article>
            <h2 class="fs-4 mb-3">Articles présents sur le blog</h2>
            <div class="table-responsive-wrap">
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Lire</th>
                        <?php if(($_SESSION['userStatus'] ?? null) === 'admin') { ?>
                        <th scope="col">Suppression</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($posts as $a_post): ?>
                        <tr>
                            <th scope="row"><?php echo $a_post->getIdpost() ?></th>
                            <td><?= htmlspecialchars((string) $a_post->getAuthor_name()) ?></td>
                            <td><?php echo htmlspecialchars((string) $a_post->getTitle()) ?></td>
                            <td><a href='/read?post_id=<?php echo $a_post->getIdpost() ?>'>Consulter</a></td>
                            <?php if(($_SESSION['userStatus'] ?? null) === 'admin') { ?>
                                <td><a href='/deletepost?post_id=<?php echo $a_post->getIdpost() ?>'>Supprimer</a></td>
                            <?php } ?>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </article>
    </section>
</main>
