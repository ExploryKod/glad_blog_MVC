<main class="container-fluid position-relative">
    <?php if(isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow position-absolute top-10 start-50 translate-middle upper-z-index">
            <p class="text-center fw-bold fs-5"><?= $message ?></p>
        </div>
    <?php endif ?>
    <section class="container-fluid custom-hero-container upper-z-index">
        <div class="d-flex justify-content-center align-item-center py-5 p-0">
            <div class="p-sm-5 pb-sm-5 mx-sm-5 bg-custom-secundary-transparent position-relative rounded-3">
                <div>
                    <h1 class="text-white text-center fs-1 pt-3">Bienvenue sur gladBlog</h1>
                    <h2 class="text-white text-center fs-3">Ecrivez et partagez!</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="container pt-5 px-5">
        <div class="container-fluid mb-5 mt-1 d-flex flex-column align-items-start justify-content-start text-white bg-dark rounded">
            <h1 class="fw-bold fs-3 text-start mt-2 mb-4"> Articles de nos blogeurs </h1>
            <p class="fs-6 text-white text-start"> Nos blogeurs ont rendu ces articles publics : vous pouvez consulter ici les premières lignes mais pour tout lire, vous devez créer un compte ou vous connecter.</p>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center gap-5">
            <?php foreach($posts as $post): ?>
                <?php if(isset($post)): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="position-relative">
                            <div class="text-wrapper upper-z-index">
                                <h5 class=""><?= $post->getTitle() ?></h5>
                                <h6> Auteur: <?= $post->getAuthor_name() ?></h6>
                                <p class=""><?= substr($post->getContent(), 0, 300) ?> (...)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </section>
</main>

