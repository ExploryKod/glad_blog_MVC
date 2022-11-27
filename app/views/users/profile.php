<?php

if($message) {
    echo 'message:';
    var_dump($message);
} elseif ($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
} elseif ($hash) {
    echo'---------hash:';
    var_dump($hash);
}

if(isset($userData)) { ?>
    <h1>Bonjour <?= $userData ?></h1>
<?php } else { ?>
    <h1>Profile</h1>
<?php } ?>
<a href="/upgrade">Devenir administrateur</a>
<a href="/deconnect">Se deconnecter</a>
<?php if(isset($status)) {
    if($status === 1) { ?>
    <a href="/backoffice" >espace d'administration</a>
    <?php }
}?>


<a href="/writer">espace de rédaction</a>

