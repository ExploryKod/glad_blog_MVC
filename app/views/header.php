<header>
    <nav class="navbar navbar-expand-lg navbar-glad">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand fw-bold" href="/">GladBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $connexion[1]?>"><?= $connexion[0] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $profilePage[1]?>"><?= $profilePage[0] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
