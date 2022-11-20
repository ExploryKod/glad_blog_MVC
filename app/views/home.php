<?php
echo '<pre>';
var_dump($posts);
echo '</pre>';
?>
<h1>HOME</h1>
    <?php foreach($posts as $post): ?>
        <div>
        <h1>Post de <?= $post->getAuthor() ?></h1>
        <p><?= $post->getContent() ?></p>
        </div>
    <?php endforeach ?>
