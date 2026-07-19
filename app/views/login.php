<main class="login-page position-relative">
    <?php if(isset($message) && !empty($message)): ?>
        <div id="fading-alert" class="alert alert-info shadow flash-alert">
            <p class="text-center fw-bold fs-5 mb-0"><?= $message ?></p>
        </div>
    <?php endif ?>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
            <input id="tab-2" type="radio" name="tab" class="sign-up">
            <div class="login-tabs">
                <label for="tab-1" class="tab tab-sign-in pointer">Se connecter</label>
                <label for="tab-2" class="tab tab-sign-up pointer">S'inscrire</label>
            </div>
            <div class="login-form">
                <form class="sign-in-htm" action="/login" method="post">
                    <div class="group">
                        <label for="username" class="label">Pseudo</label>
                        <input id="username" type="text" class="input" name="username" autocomplete="username">
                    </div>
                    <div class="group">
                        <label for="password" class="label">Mot de passe</label>
                        <input id="password" type="password" class="input" name="password" autocomplete="current-password">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Se connecter" name="login">
                    </div>
                </form>
                <form class="sign-up-htm" action="/register" method="post">
                    <div class="group">
                        <label for="user" class="label">Pseudo</label>
                        <input id="user" type="text" class="input" name="username" required autocomplete="username">
                    </div>
                    <div class="group">
                        <label for="first_name" class="label">Prénom</label>
                        <input id="first_name" type="text" class="input" name="first_name" required autocomplete="given-name">
                    </div>
                    <div class="group">
                        <label for="last_name" class="label">Nom</label>
                        <input id="last_name" type="text" class="input" name="last_name" required autocomplete="family-name">
                    </div>
                    <div class="group">
                        <label for="birth_year" class="label">Mois et année de naissance</label>
                        <input id="birth_year" type="month" class="input" name="birth_date" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Mot de passe</label>
                        <input id="pass" type="password" class="input" name="password" required autocomplete="new-password">
                    </div>
                    <div class="group">
                        <label for="email" class="label">Email</label>
                        <input id="email" type="email" class="input" name="email" required autocomplete="email">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="S'inscrire">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
