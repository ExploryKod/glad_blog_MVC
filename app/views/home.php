<?php
echo '<pre>';
var_dump($posts);
echo '</pre>';
?>

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

<h1>HOME</h1>
<h1 class="text-3xl font-bold underline text-clifford">
    Hello world!
</h1>
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
                                <p><?= $post->getContent() ?> </p>
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