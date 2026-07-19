<main class="page section position-relative">
    <?php if(isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= $message ?></p>
        </div>
    <?php endif ?>
    <div class="stack page--narrow mx-auto">
        <h1 class="fs-3">Test pour devenir administrateur</h1>
        <p class="mb-0">Quelle est la couleur du cheval blanc d'Henri IV ?</p>
        <form class="form-narrow shadow bg-light" action="/register_admin" method="POST">
            <div class="mb-3">
                <label for="admin-test" class="form-label">Votre réponse <span>*</span></label>
                <input class="form-control" id="admin-test" type="text" name="answer" maxlength="250" required>
            </div>
            <div class="d-grid">
                <input class="btn btn-primary" type="submit" value="Soumettre sa réponse" name="register-admin">
            </div>
        </form>
    </div>
</main>
