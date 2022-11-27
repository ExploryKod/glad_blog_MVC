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
        <link href="/public/css/fade.css" rel="stylesheet">

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
<?php if(isset($_headerContent)): ?>
<?= $_headerContent; ?>
<?php endif ?>
<?= $_pageContent; ?>

<?php if(isset($tailwind) && $tailwind){ ?>
    <?php foreach($_pageRelativeScripts as $script) { ?>
        <script src="<?= $script ?>"></script>
    <?php } ?>
<?php } ?>
<!-- By default we have always have bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="<?= $script ?>"></script>
</body>
</html>