<h1>You are logged</h1>

<?php
echo '<pre>';
var_dump($data);
echo '</pre>';
echo'---------';
$cost = ['cost' => 12];
$password = 'password';
$hash = password_hash($password, PASSWORD_BCRYPT, $cost);
var_dump($hash);
var_dump($password);
$verify = password_verify($password,$hash);
var_dump($verify);
?>

