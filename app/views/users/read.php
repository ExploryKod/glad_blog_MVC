<main class="position-relative">
    <?php if (!empty($_GET['success']) && $_GET['success'] === 'comment'): ?>
        <div id="fading-alert" class="alert alert-success flash-alert">
            <p class="text-center fw-bold fs-5 mb-0">Votre commentaire a bien été publié.</p>
        </div>
    <?php endif; ?>
    <?php if (!empty($_GET['error'])): ?>
        <div id="fading-alert" class="alert alert-danger flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= htmlspecialchars((string) $_GET['error']) ?></p>
        </div>
    <?php endif; ?>

    <?php
    /** @var \Gladblog\Entity\Post $thePost */
    $title = htmlspecialchars((string) $thePost->getTitle());
    $author = htmlspecialchars((string) ($thePost->getAuthor_name() ?? 'Anonyme'));
    $content = nl2br(htmlspecialchars((string) $thePost->getContent()));
    $image = trim((string) ($thePost->getImage() ?? ''));
    $postId = (int) $thePost->getIdpost();
    $loggedIn = !empty($isLoggedIn);
    ?>

    <section class="page read-layout">
        <article class="read-article">
            <p class="read-meta">Par <?= $author ?></p>
            <h1 class="read-title"><?= $title ?></h1>

            <?php if ($image !== ''): ?>
                <figure class="read-figure">
                    <img class="read-image" src="<?= htmlspecialchars($image) ?>" alt="">
                </figure>
            <?php endif; ?>

            <div class="read-body">
                <p><?= $content ?></p>
            </div>

            <div class="read-actions">
                <a href="/" class="btn btn-outline-primary btn-sm">Retour aux articles</a>
                <?php if ($loggedIn): ?>
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#write-comment">Commenter</button>
                    <a href="#comments" class="btn btn-sm btn-warning">Voir les commentaires</a>
                <?php else: ?>
                    <a href="/login?error=auth_required" class="btn btn-sm btn-success">Se connecter pour commenter</a>
                <?php endif; ?>
            </div>
        </article>

        <section id="comments" class="comments-section">
            <h2 class="comments-title">Commentaires</h2>
            <?php if (!empty($comment)): ?>
                <div class="comment-list">
                    <?php foreach ($comment as $a_comment): ?>
                        <article class="comment-item">
                            <p class="comment-item__date mb-1">Commentaire du <?= htmlspecialchars((string) $a_comment->getPublish_date()) ?></p>
                            <p class="mb-2"><?= htmlspecialchars((string) $a_comment->getContent_comment()) ?></p>
                            <p class="comment-item__author mb-0">Par <?= htmlspecialchars((string) $a_comment->getAuthor_comment()) ?></p>
                        </article>
                    <?php endforeach ?>
                </div>
            <?php else: ?>
                <p class="comments-empty">Il n’y a pas encore de commentaires sur cet article.</p>
            <?php endif ?>
        </section>
    </section>

    <?php if ($loggedIn): ?>
    <div class="modal fade" id="write-comment" tabindex="-1" aria-labelledby="write-comment-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="write-comment-label">Écrivez votre commentaire</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form class="stack" action="/register_comment" method="POST">
                        <input type="hidden" name="post_title" value="<?= $title ?>">
                        <input type="hidden" name="id_post" value="<?= $postId ?>">
                        <input type="hidden" name="author_comment" value="<?= htmlspecialchars((string) ($_SESSION['user'] ?? '')) ?>">
                        <input type="hidden" name="userId" value="<?= (int) ($_SESSION['userId'] ?? 0) ?>">
                        <div>
                            <label class="form-label fw-bold" for="content">Texte du commentaire <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content_comment" rows="8" placeholder="Entrez votre texte" maxlength="950" required></textarea>
                        </div>
                        <div class="form-actions">
                            <input class="btn btn-primary" type="submit" value="Valider" name="register_comment">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</main>
