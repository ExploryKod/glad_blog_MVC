<main class="position-relative">
    <?php if(isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= $message ?></p>
        </div>
    <?php endif ?>

    <section class="custom-hero-container">
        <div class="hero-panel bg-custom-secundary-transparent">
            <h1 class="text-white text-center fs-1 mb-2">Bienvenue sur gladBlog</h1>
            <h2 class="text-white text-center fs-4 mb-0">Ecrivez et partagez!</h2>
        </div>
    </section>

    <section class="page section">
        <div class="feed-intro text-white bg-dark">
            <h2 class="fw-bold fs-3 mb-3">Articles de nos blogueurs</h2>
            <p class="fs-6 mb-0">Nos blogueurs ont rendu ces articles publics : vous pouvez consulter ici les premières lignes, mais pour tout lire, créez un compte ou connectez-vous.</p>
        </div>

        <div class="post-grid">
            <?php foreach($posts as $post): ?>
                <?php if(isset($post)): ?>
                <article class="post-card">
                    <h3 class="fs-5 mb-0"><?= htmlspecialchars((string) $post->getTitle()) ?></h3>
                    <p class="text-muted mb-0">Auteur : <?= htmlspecialchars((string) $post->getAuthor_name()) ?></p>
                    <p><?= htmlspecialchars(substr((string) $post->getContent(), 0, 300)) ?> (…)</p>
                </article>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </section>
</main>
