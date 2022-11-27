<?php

namespace Gladblog\Controllers;

abstract class AbstractController
{

    /**
     * @param string $action
     * @param array $params
     */
    public function __construct(string $action, array $params = [])
    {
        if (!is_callable([$this, $action])) {
            throw new \RuntimeException("La methode $action n'est pas disponible dans ce controller");
        }
        call_user_func_array([$this, $action], $params);
    }

    /**
     * @param string $view
     * @param array $args
     * @param string $title
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
        if(!empty($styleLinks))
        {
            foreach($styleLinks as $link)
            {
                $absoluteLink = dirname(__DIR__,2) . $link;
                $relativeLink = $link;
                $styleLink[] = $absoluteLink;
                $relativePublicLink[] = $relativeLink;
            }
        }

        if(!empty($styleScripts))
        {
            foreach($styleScripts as $script)
            {
                $absoluteScript = dirname(__DIR__,2) . $script;
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
        $profilePage = ['',''];
        $connexion = ['Se connecter','/login'];
        if(!empty($_SESSION['userId'])) {
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