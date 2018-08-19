<?php namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Exception;

class TaskController extends AbstractController
{

    public function index()
    {
        $this->renderRaw("Hello from controller!");
    }

    public function create()
    {
        $this->renderTemplate("task/editor");
    }

    public function save()
    {
        $user = User::firstOrNew(['email' => $_POST['user_email']]);
        if(!$user->exists || $user->name != $_POST['user_name']) {
            $user->name = $_POST['user_name'];
            $user->save();
        }

        $task = new Task();
        $task->description = $_POST['task_description'];
        $user->tasks()->save($task);

        // @TODO if admin - do not show "thank's", just return to an editor
        $this->renderTemplate("task/saved");
    }

    public function show($id)
    {
        throw new Exception("Task #{$id} does not exist (exception prettifier test in controller)");
    }

}