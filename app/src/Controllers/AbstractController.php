<?php

namespace Gladblog\Controllers;

use Gladblog\Container\AppContainer;
use Gladblog\Manager\CommentsManager;
use Gladblog\Manager\PostManager;
use Gladblog\Manager\UserManager;
use Gladblog\Service\Session;

abstract class AbstractController
{
    protected AppContainer $app;

    /**
     * @param AppContainer $app Conteneur de dépendances (Managers, Session, Database)
     * @param string $action Méthode du controller à exécuter
     * @param array $params Paramètres extraits de l’URL
     */
    public function __construct(AppContainer $app, string $action, array $params = [])
    {
        $this->app = $app;

        if (!is_callable([$this, $action])) {
            throw new \RuntimeException("La methode $action n'est pas disponible dans ce controller");
        }
        call_user_func_array([$this, $action], $params);
    }

    /**
     * @return PostManager
     */
    protected function posts(): PostManager
    {
        return $this->app->posts();
    }

    /**
     * @return UserManager
     */
    protected function users(): UserManager
    {
        return $this->app->users();
    }

    /**
     * @return CommentsManager
     */
    protected function comments(): CommentsManager
    {
        return $this->app->comments();
    }

    /**
     * @return Session
     */
    protected function session(): Session
    {
        return $this->app->session();
    }

    /**
     * Redirige vers une URL puis interrompt l’exécution.
     *
     * @param string $url
     * @return void
     */
    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit();
    }

    /**
     * Assemble le layout (header + vue + base) et envoie la réponse HTML.
     *
     * @param string $view Chemin relatif sous views/
     * @param array $args Variables exposées à la vue
     * @param string $title Titre de la page
     * @param array $styleLinks Feuilles de style publiques à charger
     * @param array $styleScripts Scripts publics à charger
     * @return void
     */
    public function render(string $view, array $args = [], string $title = "Document", array $styleLinks = [], array $styleScripts = [])
    {
        $header = dirname(__DIR__, 2) . '/views/header.php';
        $view = dirname(__DIR__, 2) . '/views/' . $view;
        $base = dirname(__DIR__, 2) . '/views/base.php';
        $styleLink = [];
        $relativePublicLink = [];
        $relativePublicScript = [];
        if (!empty($styleLinks)) {
            foreach ($styleLinks as $link) {
                $absoluteLink = dirname(__DIR__, 2) . $link;
                $relativeLink = $link;
                $styleLink[] = $absoluteLink;
                $relativePublicLink[] = $relativeLink;
            }
        }

        if (!empty($styleScripts)) {
            foreach ($styleScripts as $script) {
                $absoluteScript = dirname(__DIR__, 2) . $script;
                $relativeScript = $script;
                $styleLink[] = $absoluteScript;
                $relativePublicScript[] = $relativeScript;
            }
        }

        ob_start();
        foreach ($args as $key => $value) {
            ${$key} = $value;
        }

        unset($args);
        $profilePage = ['', ''];
        $connexion = ['Se connecter', '/login'];
        if ($this->session()->isLoggedIn()) {
            $connexion[0] = 'Se déconnecter';
            $connexion[1] = '/deconnect';
            $profilePage = ['Mon espace', '/profile'];
        }
        require_once $header;
        require_once $view;
        $_pageContent = ob_get_clean();
        $_pageTitle = $title;
        $_pageStyleLinks = $styleLink;
        $_pageRelativeLinks = $relativePublicLink;
        $_pageRelativeScripts = $relativePublicScript;
        require_once $base;
        exit();
    }
}
