<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public $timestamps = false;

    protected $fillable = ['email'];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'user_id', 'id');
    }

}