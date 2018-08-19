<?php namespace App\Controllers;

use \Exception;

class TaskController extends AbstractController
{

    public function index()
    {
        $this->render("Hello from controller!");
    }

    public function show($id){
        throw new Exception("Task #{$id} does not exist (exception prettifier test in controller)");
    }

}