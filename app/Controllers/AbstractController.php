<?php namespace App\Controllers;

abstract class AbstractController
{

    protected function render(string $str)
    {
        //@TODO use template engine
        echo $str;
    }

}