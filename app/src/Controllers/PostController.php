<?php

namespace Gladblog\Controllers;

use Gladblog\Entity\Post;
use Gladblog\Exception\DomainException;
use Gladblog\Route\Route;

class PostController extends AbstractController
{
    #[Route('/', name: "homepage", methods: ["GET"])]
    public function home()
    {
        $this->render("home.php", [
            "posts" => $this->posts()->getPublicPosts()
        ], "Votre homepage");
    }

    #[Route('/writer', name: "writerpage", methods: ["GET"])]
    public function writerByGet()
    {
        $this->requireAuth();

        $postId = $_GET['id'] ?? null;
        if (isset($postId)) {
            $this->posts()->deletePost($postId);
            $this->redirect('/writer?success=deletedpost');
        }

        $this->render("users/writer.php", [
            'posts' => $this->posts()->getAllPosts()
        ], "Espace d'écriture");
    }

    #[Route('/writer', name: "writer", methods: ["POST"])]
    public function writerByPost()
    {
        $this->requireAuth();

        $this->render("users/writer.php", [
            'posts' => $this->posts()->getAllPosts()
        ], "Espace d'écriture");
    }

    #[Route('/register_post', name: "writer", methods: ["POST"])]
    public function register_post()
    {
        $this->requireAuth();

        if (!isset($_POST['register_article'])) {
            $this->redirect('/writer?error=submitnull');
        }

        try {
            $post = Post::compose(
                (string) filter_input(INPUT_POST, 'title'),
                (string) filter_input(INPUT_POST, 'content'),
                (string) filter_input(INPUT_POST, 'post_author'),
                (int) filter_input(INPUT_POST, 'userId'),
                (int) filter_input(INPUT_POST, 'article_status'),
                (string) filter_input(INPUT_POST, 'image')
            );
            $this->posts()->insertNewPost($post);
        } catch (DomainException $e) {
            $this->redirect('/writer?error=' . urlencode($e->getMessage()));
        }

        $this->redirect('/writer?success=newarticle');
    }

    #[Route('/read', name: "read", methods: ["GET", "POST"])]
    public function read_single_post()
    {
        $this->requireAuth();

        $post_id = intval($_GET['post_id'] ?? 0);

        $this->render("users/read.php", [
            'comment' => $this->comments()->getComment($post_id),
            'posts' => $this->posts()->getAllPosts(),
            'thePost' => $this->posts()->getPost($post_id),
            'id_post' => $post_id,
        ], "Espace de lecture");
    }

    #[Route('/deletepost', name: "deletepost", methods: ["GET"])]
    public function delete_single_post()
    {
        $this->requireAuth();

        $post_id = intval($_GET['post_id'] ?? 0);
        $this->posts()->deletePost($post_id);

        $this->render("users/writer.php", [
            'posts' => $this->posts()->getAllPosts(),
            'message' => 'Le post n°' . $post_id . ' a bien été supprimé.'
        ], "Espace d'écriture");
    }
}
