<?php namespace App\Controllers;

use App\Models\User;
use Exception;

class UserController extends AbstractController
{

    public function createRandom(){
        $user = new User(['email' => rand(1,99999) . 'any@e.mail']);
        $user->name = 'Any Name';
        $user->password = 'anything';
        $user->salt = 'anything';
        $user->save();
        return $this->renderTemplate('user/show', compact('user'));
    }

}