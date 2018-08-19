<?php namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Exception;

class TaskController extends AbstractController
{

    public function index()
    {
        $tasks = Task::with('user')->get();
        $this->renderTemplate("task/index", compact('tasks'));
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

        // @TODO if admin - do not redirect to list, just return to an editor
        $this->redirect("/");
    }

    public function show($id)
    {
        $task = Task::with('user')->where('id', $id)->first();
        $readonly = true;
        $this->renderTemplate("task/editor", compact('task', 'readonly'));
    }

}