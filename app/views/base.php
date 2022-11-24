<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if(isset($tailwind) && $tailwind[0]){ ?>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src=<?php $tailwind[1] ?>></script>
    <?php } else  { ?>
        <?php foreach($_pageRelativeLinks as $link) { ?>
        <link rel="stylesheet" href="<?= $link ?>">
        <?php } ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <?php } ?>
    <title><?= $_pageTitle; ?></title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
</head>
<body>

<?php
echo '<pre>';
var_dump($_POST);
echo '</pre>';
?>
<header>

</header>
<main>
    <?= $_pageContent; ?>
</main>

<footer></footer>
<?php if(isset($tailwind) && $tailwind){ ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php foreach($_pageRelativeScripts as $script) { ?>
        <script src="<?= $script ?>"></script>
    <?php } ?>
<?php } ?>

</body>
</html>