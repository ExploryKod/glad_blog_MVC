<?php ?>
<h1>Espace d'administration</h1>
<div>
    <?php
    echo "<pre>";
    var_dump($userInfos);
    echo "<pre>";
    echo "+++++++++++++++++++++++++++";
    $array = [];
    foreach($userInfos as $userInfo) {
        echo '------------------';

        $array[] = [
                    'userId' => $userInfo->getId(),
                   'username' => $userInfo->getUserName(),
                   'first_name' => $userInfo->getFirst_name(),
                   'last_name' => $userInfo->getLast_name(),
                    'email' => $userInfo->getEmail(),
                   'birth_date' => $userInfo->getBirth_date(),
                   'status' => $userInfo->getStatus()];
    }
    echo 'array is :::::::::::::';
    var_dump($array);
    ?>
</div>
<div class="container">
    <h2>Liste des utilisateurs: </h2>
    <?php  foreach($array as $arr) { ?>
        <ul class="flex flex-row gap-5">
            <?php  foreach($arr as $i) { ?>
                <?php if(!empty($i)): ?>
                    <li><?= $i ?></li>
                <?php endif ?>

            <?php } ?>
        </ul>
    <?php } ?>
</div>

<div class="container pink">
    <div class="row">
        <div class="col s6 m5">
            <form action="/deleteUser" method="post">
                <input type="text" name="username">
                <input type="number" name="userId">
                <button type="submit" name="delete">Delete this user</button>
            </form>
        </div>
    </div>
</div>

<div class="container purple">
    <div class="row">
        <div class="col s6 m5">
            <form action="/updateUser" method="post">
                <h2>Identify the user : </h2>
                <label for="username">Username</label>
                <input id="username" type="text" name="username-checked" required>
                <label for="user-id">User id</label>
                <input id="user-id" type="number" name="userId" required>

                <h2>Make your change here: </h2>
                <label for="username-change">Change Username</label>
                <input id="username-change" type="text" name="username">
                <label for="first-name">first Name</label>
                <input id="first-name" type="text" name="first_name">
                <label for="last-name">Last Name</label>
                <input id="last-name" type="text" name="last_name">
                <label for="birth-date">Birth Date</label>
                <input id="birth-date" type="text" name="birth_date">
                <label for="email">Email</label>
                <input id="email" type="text" name="email">
                <label for="status">Change status</label>
                <div class="">
                    <label for="status-select">Choisir un status:</label>
                    <select name="status" id="status-select">
                        <option value="">--Please choose an option--</option>
                        <option value="admin">Administrateur</option>
                        <option value="user">Utilisateur</option>
                        <option value="friend">Ami du blog</option>
                    </select>
                </div>
                <div class="m5">
                    <button type="submit" name="update-user">Update this user</button>
                </div>
            </form>
        </div>

    </div>

</div>


<?php if($message) {
    echo "<div class='container'>
            <p class='purple'>{$message}</p>
        </div>";

} ?>