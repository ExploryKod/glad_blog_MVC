<h1>THE POST</h1>

<?php
echo '<pre>';
var_dump($_GET['post_id']);
var_dump($posts[0]->getIdpost());
echo '<pre>';?>
<main class="container-fluid bg-light">
    <section class="row mt-5 d-flex align-items-center justify-content-center">
        <div class="col-12 w-50 card shadow p-5 bg-white" style="width: 18rem;">

                <?php foreach($posts as $post) {
                    if($post->getIdpost() === intval($_GET['post_id'])) { ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= $post->getTitle() ?></h5>
                            <p class="card-text"><?= $post->getContent() ?></p>
                            <a href="./profile.php" class="btn btn-primary btn-sm">Retour à votre profile</a>
                         </div>
                  <?php  } ?>
               <?php } ?>
        </div>
    </section>
</main>