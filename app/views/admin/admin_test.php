<section class="container">
    <h1>Terrible test pour devenir administrateur:</h1>
    <p>Quelle est la couleur du cheval blanc d'henri IV ?</p>
    <section class="container mt-5 d-flex justify-content-center align-item-center">
        <form class="shadow bg-light p-5" action="/register_admin" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Ecrivez votre réponse ici: <span>*</span> :</label>
                <input class="form-control" id="admin-test" type="text" name="answer" maxlength="250"  aria-describedby="admin-test-input"  required >
            </div>
            <div class="d-grid gap-2">
                <input class="w-100 btn btn-primary" type="submit" value="Soumettre sa réponse" name="register-admin">
            </div>
        </form>
    </section>
</section>