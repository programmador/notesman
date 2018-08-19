<?php namespace App\Controllers;

use Twig_Environment;
use Twig_Loader_Filesystem;

abstract class AbstractController
{

    private static $twig;

    protected function renderRaw(string $str)
    {
        echo $str;
    }

    protected function renderTemplate(string $template, array $args = [])
    {
        if(!self::$twig) {
            $this->loadTwig();
        }
        echo self::$twig->render($template . '.twig', $args);
    }

    private function loadTwig()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../../views');
        self::$twig = new Twig_Environment($loader, array(
            'cache' => __DIR__.'/../../storage/views_cache',
        ));
    }

}