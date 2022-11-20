<?php
echo '<pre>';
var_dump($posts);
echo '</pre>';
?>
<h1>HOME</h1>

<div class="container">
    <div class="row">
        <div class="col s12 m7">
            <?php foreach($posts as $post): ?>
            <div class="row">
                <div class="col s12 m7">
                    <div class="card">
                        <div class="card-image">
                            <img src="https://images.pexels.com/photos/12179283/pexels-photo-12179283.jpeg">
                            <span class="card-title"><?= $post->getTitle() ?></span>
                        </div>
                        <div class="card-content">
                            <p><?= $post->getContent() ?> </p>
                        </div>
                        <div class="card-action">
                            <p>En savoir plus sur <a href="#"><?= $post->getAuthor() ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="row blue lighten-5">
        <h1>Formulaire d'inscription</h1>
        <form class="col s12" action="/profile.php" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="username" type="text">
                    <label for="username">Pseudo</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>


        </form>
    </div>
</div>