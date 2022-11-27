<main class="container-fluid position-relative m-0 p-0 gap-0">
    <?php if(isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow position-absolute top-10 start-50 translate-middle upper-z-index">
            <p class="text-center fw-bold fs-5"><?= $message ?></p>
        </div>
    <?php endif ?>
    <section class="container-fluid custom-hero-container m-0 p-0 upper-z-index">
        <div class="d-flex justify-content-center align-item-center py-5 p-0">
            <div class="p-sm-5 pb-sm-5 mx-sm-5 bg-custom-secundary-transparent position-relative rounded-3">
                <div>
                    <h1 class="text-white text-center fs-1 pt-3">Bienvenue sur votre espace</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid p-0 m-0 mb-5">
        <?php if(isset($userData)) { ?>
        <div class="container-fluid bg-dark p-0 m-0 d-flex align-items-start justify-content-start flex-column">
            <h1 class="text-white fw-bold fs-2 mt-2 mb-2 ms-2">Bonjour <?= $userData ?></h1>
            <p class="text-white fs-5 mb-2 ms-2">Nous vous souhaitons la bienvenue et espérons que vous allez être inspiré.</p>
        </div>
        <?php } else { ?>
            <h1>Bienvenue</h1>
        <?php } ?>
    </section>
    <section class="container d-flex align-items-center justify-items-center flex-column p-5 bg-light shadow rounded">
        <h1 class="fs-2 mb-5 mt-2"> Votre tableau de bord: </h1>
        <div class="d-grid flex-column align-items-center justify-content-center gap-3">
            <?php if(isset($status)) {
            if($status !== 'admin') { ?>
            <a class="btn btn-lg btn-info" role="button" href="/upgrade">Devenir administrateur</a>
            <?php } }?>
            <?php if(isset($status)) {
                if($status === 'admin') { ?>
                    <a class="btn btn-lg btn-warning" href="/backoffice" >espace d'administration</a>
                <?php } }?>
            <a class="btn btn-lg btn-success" role="button" href="/writer"> Rédiger un post </a>
        </div>
    </section>
</main>