<?php namespace App\Controllers;

use App\Models\User;
use Exception;

class TaskController extends AbstractController
{

    public function index()
    {
        $this->renderRaw("Hello from controller!");
    }

    public function show($id){
        throw new Exception("Task #{$id} does not exist (exception prettifier test in controller)");
    }

}