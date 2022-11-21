
<div class="container">
    <div class="row blue lighten-5">
        <h1>Formulaire d'inscription</h1>
        <form class="col s12" action="/register" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="username" type="text" name="username">
                    <label for="username">Pseudo</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" name="password">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="signin">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="row purple lighten-5 m7">
        <h1>Formulaire de login</h1>
        <form class="col s12" action="/login" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <input id="username" name="username" type="text">
                    <label for="username">Pseudo</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password" name="password" type="password">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="login">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>