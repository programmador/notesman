<?php namespace App\Controllers;

use App\Models\User;
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

    public function create(){
        $user = new User(['email' => rand(1,99999) . 'any@e.mail']);
        $user->name = 'Any Name';
        $user->password = 'anything';
        $user->salt = 'anything';
        $user->save();
        return $this->render(print_r($user->toArray(), true));
    }

}