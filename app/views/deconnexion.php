<?php
session_start();
if(isset($_SESSION['user'])){
    echo 'Tu est ' .$_SESSION['user']. '<br>';
    unset($_SESSION['user']);
}
echo 'voici session user: '.$_SESSION['user'];

?>