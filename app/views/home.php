<?php
echo '<pre>';
var_dump($posts);
echo '</pre>';
?>
<h1>HOME</h1>
<a href="login.php"></a>
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
</div>