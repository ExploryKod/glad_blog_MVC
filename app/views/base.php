<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if(isset($tailwind) && $tailwind[0]){ ?>
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
        <script src='/public/js/tailwind.js'></script>
    <?php } else  { ?>
        <?php foreach($_pageRelativeLinks as $link) { ?>
        <link rel="stylesheet" href="<?= $link ?>">
        <?php } ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="/public/css/variables.css" rel="stylesheet">
        <link href="/public/css/utilities.css" rel="stylesheet">
        <link href="/public/css/hero.css" rel="stylesheet">

    <?php } ?>
    <title><?= $_pageTitle; ?></title>
</head>
<body>
<?php
echo '<pre>';
var_dump($_POST);
echo '</pre>';
echo '<pre> --- Session';
var_dump($_SESSION);
echo '</pre>';
?>
<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="container-fluid custom-hero-container">
        <div class="d-flex justify-content-center align-item-center py-5 p-0">
            <div class="p-sm-5 pb-sm-5 mx-sm-5 bg-custom-secundary-transparent position-relative rounded-3">
                <div>
                    <h1 class="text-white text-center fs-1 pt-3">Bienvenue sur gladBlog</h1>
                    <h2 class="text-white text-center fs-3">Ecrivez et partagez!</h2>
                </div>
            </div>
        </div>
    </section>
</header>
<?= $_pageContent; ?>

<?php if(isset($tailwind) && $tailwind){ ?>
    <?php foreach($_pageRelativeScripts as $script) { ?>
        <script src="<?= $script ?>"></script>
    <?php } ?>
<?php } else { ?>
<!-- By default we have bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<?php } ?>
</body>
</html>