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




if($userData) {
    var_dump($userData);
}
?>
<h1>Profile</h1>

<a href="/backoffice" >espace admin</a>

