<?php ?>
<div>
    <?php
    $array = [];
    foreach($userInfos as $userInfo) {
        $array[] = [
                    'userId' => $userInfo->getId(),
                   'username' => $userInfo->getUserName(),
                   'first_name' => $userInfo->getFirst_name(),
                   'last_name' => $userInfo->getLast_name(),
                    'email' => $userInfo->getEmail(),
                   'birth_date' => $userInfo->getBirth_date(),
                   'status' => $userInfo->getStatus()];
    } ?>
</div>
<main class="container-fluid position-relative">
    <?php if(isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow position-absolute top-10 start-50 translate-middle upper-z-index">
            <p class="text-center fw-bold fs-5"><?= $message ?></p>
        </div>
    <?php endif ?>
    <section class="container-fluid custom-hero-container upper-z-index">
        <div class="d-flex justify-content-center align-item-center py-5 p-0">
            <div class="p-sm-5 pb-sm-5 mx-sm-5 bg-custom-secundary-transparent position-relative rounded-3">
                <div>
                    <h1 class="text-white text-center fs-1 pt-3">Bienvenue sur votre espace</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid p-5 bg-dark">
        <h1 class="fs-1 text-white text-center">Espace d'administration</h1>
    </section>
        <section class="container-fluid p-5 bg-dark d-flex justify-content-center align-items-center flex-column">
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Consulter les informations utilisateurs
                </button>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog border-0 modal-xl">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h1 class="modal-title fs-3 ms-2" id="exampleModalLabel">Informations sur les utilisateurs: </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <table class="table table-striped border border-2">
                                    <thead>
                                    <tr>
                                        <?php  foreach($array[0] as $key => $value) { ?>
                                            <th scope="col"><?= $key ?></th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach($array as $arr) { ?>
                                        <tr>
                                            <?php  foreach($arr as $i) { ?>
                                                <?php if(!empty($i)) { ?>
                                                    <td><?= $i ?></td>
                                                <?php } else { ?>
                                                    <td>Pas de valeur</td>
                                                <?php } ?>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    <section class="container-fluid">
        <article class="row justify-content-center pt-3 mx-5 my-2 shadow bg-light rounded">
            <div class="col-10">
                <h1 class="fs-4 fw-bold text-center mb-2 mt-2"> Manipulations sur les utilisateurs : </h1>
                <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                    <div class="container">
                        <h2 class="fs-3 fw-bold text-center mb-2">Suppression de compte: </h2>
                        <form action="/deleteUser" method="post">
                            <div class="mb-3">
                                <label class="form-label"  for="username">Pseudo exact:</label>
                                <input class="form-control" id="username" type="text" name="username">
                            </div>
                            <div class="mb-3">
                            <label class="form-label"  for="user-id">id de l'utilisateur:</label>
                            <input class="form-control"  id="user-id" type="number" name="userId">
                            </div>
                            <div class="d-grid mt-2 mb-2">
                            <button class="mx-5 btn btn-sm btn-danger" type="submit" name="delete">Delete this user</button>
                            </div>
                        </form>
                    </div>
                    <div class="container mt-2">
                        <h2 class="fs-3 fw-bold text-center mb-2"> Changer des informations de l'utilisateur </h2>
                        <form action="/updateUser" method="post">
                            <h5 class="fs-5 fw-bold mt-2 mb-2"> Identifiez l'utilisateur: </h5>
                            <label class="form-label"  for="username">Username</label>
                            <input class="form-control"  id="username" type="text" name="username-checked" required>
                            <label class="form-label"  for="user-id">User id</label>
                            <input class="form-control"  id="user-id" type="number" name="userId" required>

                            <h2 class="fs-5 fw-bold mt-2 mb-2"> Changer des informations: </h2>
                            <p>- Répétez toute les informations et changer celles qu'il faut modifier -</p>
                            <label class="form-label"  for="username-change">Pseudo:</label>
                            <input class="form-control"  id="username-change" type="text" name="username">
                            <label class="form-label"  for="first-name">Prénom: </label>
                            <input class="form-control"  id="first-name" type="text" name="first_name">
                            <label class="form-label"  for="last-name">Nom de famille: </label>
                            <input class="form-control"  id="last-name" type="text" name="last_name">
                            <label class="form-label"  for="birth-date">Date de naissance: </label>
                            <input class="form-control"  id="birth-date" type="text" name="birth_date">
                            <label class="form-label"  for="email">Email: </label>
                            <input class="form-control"  id="email" type="text" name="email">
                            <label class="form-label"  for="status">Status </label>
                            <div class="mb-3">
                                <label for="status-select">Choisir un status:</label>
                                <select name="status" id="status-select">
                                    <option value="user">Utilisateur</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                            </div>
                            <div class="d-grid mx-5 mt-2 mb-2">
                                <button class="btn btn-sm btn-success" type="submit" name="update-user">Valider les changements</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </section>
</main>