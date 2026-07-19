<main class="position-relative">
    <?php if (isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= htmlspecialchars((string) $message) ?></p>
        </div>
    <?php endif ?>

    <?php
    $displayName = htmlspecialchars((string) ($userData ?? 'lecteur'));
    $isAdmin = isset($status) && $status === 'admin';
    $roleBadges = $isAdmin ? ['Auteur', 'Administrateur'] : ['Auteur'];
    $email = htmlspecialchars((string) ($userEmail ?? ''));
    $fullName = trim(($userFirstName ?? '') . ' ' . ($userLastName ?? ''));
    $fullName = $fullName !== '' ? htmlspecialchars($fullName) : null;
    $statusLabel = $isAdmin ? 'Administrateur' : 'Auteur';
    ?>

    <section class="profile-hero">
        <div class="page">
            <div class="profile-hero__inner">
                <p class="profile-hero__eyebrow">Mon espace</p>
                <h1 class="profile-hero__title">Bonjour <?= $displayName ?></h1>
                <p class="profile-hero__lead">Retrouvez ici vos actions d’écriture et d’administration.</p>
                <div class="profile-roles">
                    <span class="profile-roles__label">Mes rôles :</span>
                    <?php foreach ($roleBadges as $roleBadge): ?>
                        <span class="profile-badge"><?= htmlspecialchars($roleBadge) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="page section profile-dashboard">
        <header class="profile-dashboard__header">
            <h2 class="profile-dashboard__title">Votre tableau de bord</h2>
            <p class="profile-dashboard__subtitle">Choisissez une action pour continuer.</p>
        </header>

        <div class="profile-actions">
            <a class="profile-action" href="/writer">
                <span class="profile-action__label">Écrire</span>
                <span class="profile-action__title">Rédiger un post</span>
                <span class="profile-action__text">Composez un nouvel article pour le blog.</span>
            </a>

            <?php if ($isAdmin): ?>
                <a class="profile-action profile-action--accent" href="/backoffice">
                    <span class="profile-action__label">Admin</span>
                    <span class="profile-action__title">Espace d’administration</span>
                    <span class="profile-action__text">Gérez les comptes utilisateurs.</span>
                </a>
            <?php else: ?>
                <a class="profile-action profile-action--soft" href="/upgrade">
                    <span class="profile-action__label">Accès</span>
                    <span class="profile-action__title">Devenir administrateur</span>
                    <span class="profile-action__text">Passez le quiz pour débloquer le backoffice.</span>
                </a>
            <?php endif; ?>

            <a class="profile-action profile-action--muted" href="/">
                <span class="profile-action__label">Lecture</span>
                <span class="profile-action__title">Voir le blog</span>
                <span class="profile-action__text">Retournez à la page d’accueil.</span>
            </a>
        </div>

        <aside class="profile-summary">
            <h3 class="profile-summary__title">Compte</h3>
            <dl class="profile-summary__list">
                <div>
                    <dt>Pseudo</dt>
                    <dd><?= $displayName ?></dd>
                </div>
                <?php if ($fullName): ?>
                    <div>
                        <dt>Nom</dt>
                        <dd><?= $fullName ?></dd>
                    </div>
                <?php endif; ?>
                <?php if ($email !== ''): ?>
                    <div>
                        <dt>Email</dt>
                        <dd><?= $email ?></dd>
                    </div>
                <?php endif; ?>
                <div>
                    <dt>Statut</dt>
                    <dd><?= $statusLabel ?></dd>
                </div>
            </dl>
        </aside>
    </section>
</main>
