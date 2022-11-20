<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php foreach($_pageRelativeLinks as $link) { ?>
    <link rel="stylesheet" href="<?= $link ?>">
    <?php } ?>

    <title><?= $_pageTitle; ?></title>
</head>
<body>

<?= $_pageContent; ?>

<?php foreach($_pageRelativeScripts as $script) { ?>
    <script src="<?= $script ?>"></script>
<?php } ?>

</body>
</html>