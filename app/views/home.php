<section class="container-fluid custom-hero-container">
    <div class="d-flex justify-content-center align-item-center py-5 p-0">
        <div class="p-sm-5 pb-sm-5 mx-sm-5 bg-custom-secundary-transparent position-relative rounded-3">
            <div>
                <h1 class="text-white text-center fs-1 pt-3">Bienvenue sur gladBlog</h1>
                <h2 class="text-white text-center fs-3">Ecrivez et partagez!</h2>
            </div>
        </div>
    </div>
</section>

<?php
if(isset($_GET['error']) && ($_GET['error'] === 'password-no-ok')) {
    echo '<div class="container blue light-blue">
            <div class="row">
                <p class="">Mot de passe invalide</p>
            </div>
        </div>';
}

if(isset($_GET['error']) && ($_GET['error'] === 'notfound')) {
    echo '<div class="container grey">
    <div class="row">
        <p class="">Nous ne vous avons pas trouvé</p>
    </div>
</div>';
}

if(isset($_GET['error']) && ($_GET['error'] === 'no-user')) {
    echo '<div class="container grey">
    <div class="row">
        <p class="">Nous ne vous avons pas trouvé</p>
    </div>
</div>';
}

?>


<a href="/deconnect">Deconnection</a>
<a href="/login">login</a>
<section class="container">
    <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 200 }'>
        <?php foreach($posts as $post): ?>
            <div class="grid-item">
                <div class="row">
                    <div class="col s12 m7">
                        <div class="card">
                            <div class="card-image">
                                <span class="card-title"><?= $post->getTitle() ?></span>
                            </div>
                            <div class="card-content">
                                <p><?= substr($post->getContent(), 0, 300) ?> (...)</p>
                            </div>
                            <div class="card-action">
                                <p>En savoir plus sur <a href="author?name=<?= $post->getAuthor() ?>"><?= $post->getAuthor_name() ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>


<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col s12 m7">-->
<!--            --><?php //foreach($posts as $post): ?>
<!--            <div class="row">-->
<!--                <div class="col s12 m7">-->
<!--                    <div class="card">-->
<!--                        <div class="card-image">-->
<!--                            <img src="https://images.pexels.com/photos/12179283/pexels-photo-12179283.jpeg">-->
<!--                            <span class="card-title">--><?//= $post->getTitle() ?><!--</span>-->
<!--                        </div>-->
<!--                        <div class="card-content">-->
<!--                            <p>--><?//= $post->getContent() ?><!-- </p>-->
<!--                        </div>-->
<!--                        <div class="card-action">-->
<!--                            <p>En savoir plus sur <a href="#">--><?//= $post->getAuthor() ?><!--</a></p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            --><?php //endforeach ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->