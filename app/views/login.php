<main class="container-fluid bg-dark">
    <div class="login-wrap">
        <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in pointer" checked><label for="tab-1" class="tab tab-1 pointer">Se connecter</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up pointer"><label for="tab-2" class="tab tab-2 pointer">S'inscrire</label>
            <div class="login-form">
                <form class="sign-in-htm" action="/login" method="post">
                    <div class="group">
                        <label for="user" class="label">Pseudo:</label>
                        <input id="user" type="text" class="input" name="username">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password:</label>
                        <input id="pass" type="password" class="input" data-type="password" name="password">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Se connecter" name="login">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot">Forgot Password?</a>
                    </div>
                </form>
                <form class="sign-up-htm" action="/register" method="post">
                    <div class="group">
                        <label for="user" class="label">Pseudo choisi:</label>
                        <input id="user" type="text" class="input" name="username">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email</label>
                        <input id="pass" type="email" class="input" name="email">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="S'inscrire">
                    </div>
                    <div class="hr"></div>
                </form>
            </div>
        </div>
    </div>
</main>
