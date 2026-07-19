<main class="position-relative">
    <?php if (!empty($_GET['success']) && $_GET['success'] === 'comment'): ?>
        <div id="fading-alert" class="alert alert-success shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0">Votre commentaire a bien été publié.</p>
        </div>
    <?php endif; ?>
    <?php if (!empty($_GET['error'])): ?>
        <div id="fading-alert" class="alert alert-danger shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= htmlspecialchars((string) $_GET['error']) ?></p>
        </div>
    <?php endif; ?>

    <section class="page read-layout">
        <article class="read-article card shadow">
            <?php foreach($posts as $post) {
                if($post->getIdpost() === intval($_GET['post_id'] ?? 0)) { ?>
                    <h1 class="fs-3 mb-3"><?= htmlspecialchars((string) $post->getTitle()) ?></h1>
                    <p class="text-wrap mb-4"><?= nl2br(htmlspecialchars((string) $post->getContent())) ?></p>
                    <div class="read-actions">
                        <a href="/profile" class="btn btn-primary btn-sm">Retour au profil</a>
                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#write-comment">Commentez l'article</button>
                        <a href="#comments" class="btn btn-sm btn-warning">Voir les commentaires</a>
                    </div>
            <?php  } ?>
            <?php } ?>
        </article>

        <section id="comments" class="comments-section bg-light">
            <h2 class="fw-bold text-center fs-3 mb-4">Commentaires</h2>
            <?php if(isset($comment) && !empty($comment)): ?>
                <div class="comment-list">
                    <?php foreach($comment as $a_comment): ?>
                        <article class="comment-item">
                            <p class="fs-6 fw-bold mb-1">Commentaire du <?= htmlspecialchars((string) $a_comment->getPublish_date()) ?></p>
                            <p class="mb-2"><?= htmlspecialchars((string) $a_comment->getContent_comment()) ?></p>
                            <p class="fw-bold fs-6 mb-0">Par <?= htmlspecialchars((string) $a_comment->getAuthor_comment()) ?></p>
                        </article>
                    <?php endforeach ?>
                </div>
            <?php else: ?>
                <p class="fw-bold fs-5 text-center my-4 mx-auto">Il n'y a pas encore de commentaires sur ce post</p>
            <?php endif ?>
        </section>
    </section>

    <div class="modal fade" id="write-comment" tabindex="-1" aria-labelledby="write-comment-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="write-comment-label">Écrivez votre commentaire</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="stack" action="/register_comment" method="POST">
                        <?php foreach($posts as $post) {
                        if($post->getIdpost() === intval($_GET['post_id'] ?? 0)) { ?>
                        <input type="hidden" name="post_title" value="<?= htmlspecialchars((string) $post->getTitle()) ?>">
                        <input type="hidden" name="id_post" value="<?= (int) $post->getIdpost() ?>">
                        <?php  } ?>
                        <?php } ?>
                        <input type="hidden" name="author_comment" value="<?= htmlspecialchars((string) ($_SESSION['user'] ?? '')) ?>">
                        <input type="hidden" name="userId" value="<?= (int) ($_SESSION['userId'] ?? 0) ?>">
                        <div>
                            <label class="form-label fw-bold" for="content">Texte du commentaire <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content_comment" rows="8" placeholder="Entrez votre texte" maxlength="950" required></textarea>
                        </div>
                        <div class="d-grid">
                            <input class="btn btn-primary btn-lg" type="submit" value="Valider" name="register_comment">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
