<?php

if(isset($message)) {
    echo 'message:';
    var_dump($message);
} elseif (isset($data)) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
} elseif (isset($hash)) {
    echo'---------hash:';
    var_dump($hash);
}

if(isset($userData)) { ?>
    <h1>Bonjour <?= $userData ?></h1>
<?php } else { ?>
    <h1>Profile</h1>
<?php } ?>
<a class="btn btn-success" role="button" href="/upgrade">Devenir administrateur</a>

<?php if(isset($status)) {
    if($status === 'admin') { ?>
    <a href="/backoffice" >espace d'administration</a>
    <?php }
}?>


<a class="btn btn-success" role="button" href="/writer"> Rédiger un post </a>

