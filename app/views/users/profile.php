<main class="position-relative">
    <?php if(isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= $message ?></p>
        </div>
    <?php endif ?>

    <section class="custom-hero-container">
        <div class="hero-panel bg-custom-secundary-transparent">
            <h1 class="text-white text-center fs-1 mb-0">Bienvenue sur votre espace</h1>
        </div>
    </section>

    <section class="profile-welcome bg-dark">
        <?php if(isset($userData)) { ?>
            <h2 class="text-white fw-bold fs-3 mb-2">Bonjour <?= htmlspecialchars((string) $userData) ?></h2>
            <p class="text-white fs-5 mb-0">Nous vous souhaitons la bienvenue et espérons que vous allez être inspiré.</p>
        <?php } else { ?>
            <h2 class="text-white">Bienvenue</h2>
        <?php } ?>
    </section>

    <section class="page section--tight">
        <div class="dashboard bg-light shadow">
            <h2 class="fs-3 mb-4 text-center">Votre tableau de bord</h2>
            <div class="d-grid gap-3">
                <?php if(isset($status) && $status !== 'admin') { ?>
                    <a class="btn btn-lg btn-info" role="button" href="/upgrade">Devenir administrateur</a>
                <?php } ?>
                <?php if(isset($status) && $status === 'admin') { ?>
                    <a class="btn btn-lg btn-warning" href="/backoffice">Espace d'administration</a>
                <?php } ?>
                <a class="btn btn-lg btn-success" role="button" href="/writer">Rédiger un post</a>
            </div>
        </div>
    </section>
</main>
