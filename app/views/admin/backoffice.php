<main class="position-relative">
    <?php if (!empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= htmlspecialchars((string) $message) ?></p>
        </div>
    <?php endif ?>

    <section class="custom-hero-container">
        <div class="hero-panel bg-custom-secundary-transparent">
            <h1 class="text-white text-center fs-1 mb-0">Espace d'administration</h1>
        </div>
    </section>

    <section class="page section">
        <div class="admin-panel bg-light shadow rounded">
            <header class="mb-4">
                <h2 class="fs-4 mb-1">Utilisateurs</h2>
                <p class="text-muted mb-0">Liste des comptes — modifiez ou supprimez directement depuis chaque ligne.</p>
            </header>

            <?php if (empty($userInfos)): ?>
                <p class="mb-0">Aucun utilisateur en base.</p>
            <?php else: ?>
                <div class="admin-user-list">
                    <table class="table table-striped align-middle">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Statut</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($userInfos as $userInfo): ?>
                            <?php
                            $uid = (int) $userInfo->getId();
                            $uname = (string) ($userInfo->getUsername() ?? '');
                            $fname = (string) ($userInfo->getFirst_name() ?? '');
                            $lname = (string) ($userInfo->getLast_name() ?? '');
                            $email = (string) ($userInfo->getEmail() ?? '');
                            $birth = (string) ($userInfo->getBirth_date() ?? '');
                            $status = (string) ($userInfo->getStatus() ?? 'user');
                            $isSelf = isset($your_id) && (int) $your_id === $uid;
                            ?>
                            <tr>
                                <td><?= $uid ?></td>
                                <td><?= htmlspecialchars($uname) ?></td>
                                <td><?= htmlspecialchars(trim($fname . ' ' . $lname) ?: '—') ?></td>
                                <td><?= htmlspecialchars($email !== '' ? $email : '—') ?></td>
                                <td><span class="badge text-bg-secondary"><?= htmlspecialchars($status) ?></span></td>
                                <td>
                                    <div class="admin-actions">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary js-edit-user"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal"
                                            data-userid="<?= $uid ?>"
                                            data-username="<?= htmlspecialchars($uname, ENT_QUOTES) ?>"
                                            data-first-name="<?= htmlspecialchars($fname, ENT_QUOTES) ?>"
                                            data-last-name="<?= htmlspecialchars($lname, ENT_QUOTES) ?>"
                                            data-email="<?= htmlspecialchars($email, ENT_QUOTES) ?>"
                                            data-birth-date="<?= htmlspecialchars($birth, ENT_QUOTES) ?>"
                                            data-status="<?= htmlspecialchars($status, ENT_QUOTES) ?>"
                                        >Modifier</button>

                                        <form
                                            action="/deleteUser"
                                            method="post"
                                            onsubmit="return confirm(<?= $isSelf
                                                ? json_encode('Supprimer votre propre compte ? Vous serez déconnecté immédiatement.')
                                                : json_encode('Supprimer le compte « ' . $uname . ' » ?')
                                            ?>);"
                                        >
                                            <input type="hidden" name="username" value="<?= htmlspecialchars($uname) ?>">
                                            <input type="hidden" name="userId" value="<?= $uid ?>">
                                            <button class="btn btn-sm btn-danger" type="submit" name="delete">
                                                <?= $isSelf ? 'Supprimer mon compte' : 'Supprimer' ?>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="editUserModalLabel">Modifier l'utilisateur</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <form class="admin-edit-form" action="/updateUser" method="post">
                    <div class="modal-body stack">
                        <input type="hidden" name="username-checked" id="edit-username-checked">
                        <input type="hidden" name="userId" id="edit-user-id">

                        <div class="form-row-2">
                            <div>
                                <label class="form-label" for="edit-username">Pseudo</label>
                                <input class="form-control" id="edit-username" type="text" name="username">
                            </div>
                            <div>
                                <label class="form-label" for="edit-status">Statut</label>
                                <select class="form-select" name="status" id="edit-status">
                                    <option value="user">Utilisateur</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div>
                                <label class="form-label" for="edit-first-name">Prénom</label>
                                <input class="form-control" id="edit-first-name" type="text" name="first_name">
                            </div>
                            <div>
                                <label class="form-label" for="edit-last-name">Nom</label>
                                <input class="form-control" id="edit-last-name" type="text" name="last_name">
                            </div>
                        </div>

                        <div>
                            <label class="form-label" for="edit-email">Email</label>
                            <input class="form-control" id="edit-email" type="email" name="email">
                        </div>

                        <div class="form-row-2">
                            <div>
                                <label class="form-label" for="edit-birth-date">Date de naissance</label>
                                <input class="form-control" id="edit-birth-date" type="text" name="birth_date" placeholder="AAAA-MM">
                            </div>
                            <div>
                                <label class="form-label" for="edit-password">Nouveau mot de passe</label>
                                <input class="form-control" id="edit-password" type="password" name="password" autocomplete="new-password" placeholder="Laisser vide pour ne pas changer">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer form-actions border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button class="btn btn-success" type="submit" name="update-user" value="1">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.querySelectorAll('.js-edit-user').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.getElementById('edit-user-id').value = btn.dataset.userid || '';
        document.getElementById('edit-username-checked').value = btn.dataset.username || '';
        document.getElementById('edit-username').value = btn.dataset.username || '';
        document.getElementById('edit-first-name').value = btn.dataset.firstName || '';
        document.getElementById('edit-last-name').value = btn.dataset.lastName || '';
        document.getElementById('edit-email').value = btn.dataset.email || '';
        document.getElementById('edit-birth-date').value = btn.dataset.birthDate || '';
        document.getElementById('edit-password').value = '';
        var status = btn.dataset.status || 'user';
        var statusSelect = document.getElementById('edit-status');
        statusSelect.value = status === 'admin' ? 'admin' : 'user';
    });
});
</script>
