<main class="container-fluid position-relative">
    <?php if (!empty($_GET['success']) && $_GET['success'] === 'comment'): ?>
        <div id="fading-alert" class="alert alert-success shadow position-absolute top-10 start-50 translate-middle upper-z-index">
            <p class="text-center fw-bold fs-5 mb-0">Votre commentaire a bien été publié.</p>
        </div>
    <?php endif; ?>
    <?php if (!empty($_GET['error'])): ?>
        <div id="fading-alert" class="alert alert-danger shadow position-absolute top-10 start-50 translate-middle upper-z-index">
            <p class="text-center fw-bold fs-5 mb-0"><?= htmlspecialchars((string) $_GET['error']) ?></p>
        </div>
    <?php endif; ?>
    <section class="row mt-5 d-flex align-items-center justify-content-center">
        <div class="col-12 w-50 card shadow p-5 bg-white" style="width: 30rem;">
                <?php foreach($posts as $post) {
                    if($post->getIdpost() === intval($_GET['post_id'])) { ?>
                        <div class="container">
                            <div class="row justify-content-center align-items-start">
                                <div>
                                    <h5 class="col-12"><?= $post->getTitle() ?></h5>
                                </div>
                                <div class="col-12">
                                    <p class="text-wrap"><?= $post->getContent() ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center flex-col gap-2">
                                <a href="/profile" class="btn btn-primary btn-sm">Retour à votre profile</a>
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#write-comment">Commentez l'article</button>
                                <a href="#comments" class="btn btn-sm btn-warning">Voir les commentaires</a>
                            </div>
                         </div>
                  <?php  } ?>
               <?php } ?>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal modal-dialog-scrollable fade" id="write-comment" tabindex="-1" aria-labelledby="write-comment" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-white">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="write-comment-label">Ecrivez ici votre commentaire: </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column" action="/register_comment" method="POST">
                        <?php foreach($posts as $post) {
                        if($post->getIdpost() === intval($_GET['post_id'])) { ?>
                        <input class="form-control" id="post_title" type="hidden" name="post_title" maxlength="250" value="<?= htmlspecialchars((string) $post->getTitle()) ?>">
                        <input class="form-control" id="id_post" type="hidden" name="id_post" value="<?= (int) $post->getIdpost() ?>">
                        <?php  } ?>
                        <?php } ?>
                        <input type="hidden" id="author_name" name="author_comment" maxlength="250" value="<?= htmlspecialchars((string) ($_SESSION['user'] ?? '')) ?>">
                        <input type="hidden" id="prodId" name="userId" value="<?= (int) ($_SESSION['userId'] ?? 0) ?>">
                        <div class="mb-1">
                                <label class="form-label fw-bold fs-5 text-center" for="content">Texte du commentaire:<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="content" name="content_comment" cols="60" rows="10" placeholder="Entrez votre texte" maxlength="950" required></textarea>
                        </div>
                        <div class="mb-1">
                            <input class="btn btn-primary btn-lg" type="submit" value="Valider" name="register_comment">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <section  id="comments" class="container-fluid bg-light">
        <h2 class="fw-bold text-center fs-2"> Commentaires: </h2>
        <?php if(isset($comment)): ?>
            <?php if(!empty($comment)): ?>
                <div class="container-fluid d-flex flex-column">
                    <?php foreach($comment as $a_comment): ?>
                        <div class="d-flex flex-column">
                            <h6 class="fs-6 fw-bold">Commentaire du <?= $a_comment->getPublish_date() ?></h6>
                            <p class=""><?= $a_comment->getContent_comment() ?></p>
                            <h5 class="fw-bold fs-6">Par <?= $a_comment->getAuthor_comment() ?></h5>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        <?php else: ?>
            <p class="fw-bold fs-4 text-center mt-5 mb-5 mx-auto"> Il n'y a pas encore de commentaires sur ce post</p>
        <?php endif ?>
    </section>

</main>