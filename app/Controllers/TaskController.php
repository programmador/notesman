<?php namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Exception;

class TaskController extends AbstractController
{

    const MAX_IMG_WIDTH = 320;
    const MAX_IMG_HEIGHT = 240;

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
        $task->saveImageBlob($this->getUploadedImage());
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

    private function getUploadedImage()
    {
        if(!isset($_FILES['task_image'])) {
            return null;
        }
        $filePath = $_FILES['task_image']['tmp_name'];
        if(!$imgInfo = getimagesize($filePath)) {
            return null;
        }

        list($width, $height) = $imgInfo;
        if($width > self::MAX_IMG_WIDTH || $height > self::MAX_IMG_WIDTH) {
            return $this->getResizedImageContent($filePath, $imgInfo);
        }
        return file_get_contents($filePath);
    }

    function getResizedImageContent(string $path, array $imgInfo)
    {
        $file = $this->createThumbnail($path, $imgInfo['mime']);
        if(is_resource($file)) {
            $content = stream_get_contents($file, -1, 0);
            fclose($file);
            return $content;
        } else {
            return null;
        }
    }

    function createThumbnail(string $path, string $mime)
    {
        $png = $mime == 'image/png';
        $jpg = in_array($mime, ['image/jpg', 'image/jpeg', 'image/pjpeg']);

        if($png) {
            $src = imagecreatefrompng($path);
        } elseif ($jpg) {
            $src = imagecreatefromjpeg($path);
        } else {
            throw new Exception("Unsupported image format");
        }

        $oldWidth = imageSX($src);
        $oldHeight = imageSY($src);

        $ratio = $oldWidth / $oldHeight;
        $defaultRatio = self::MAX_IMG_WIDTH / self::MAX_IMG_HEIGHT;

        if($ratio > $defaultRatio) {
            $newWidth = self::MAX_IMG_WIDTH;
            $newHeight = (int)($newWidth / $ratio);
        } else {
            $newHeight = self::MAX_IMG_HEIGHT;
            $newWidth = (int)($newHeight * $ratio);
        }

        $dst = ImageCreateTrueColor($newWidth, $newHeight);

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

        $descriptor = tmpfile();
        if($png) {
            imagepng($dst, $descriptor, 8);
        } elseif ($jpg) {
            imagejpeg($dst, $descriptor, 80);
        }

        imagedestroy($dst);
        imagedestroy($src);

        return $descriptor;
    }

}