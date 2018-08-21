<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getImageHex()
    {
        return base64_encode($this->image);
    }

    public function getImageInfo() : array
    {
        if(!$this->image) {
            return [];
        }
        return getimagesizefromstring($this->image);
    }

    public function getImageMime()
    {
        return $this->getImageInfo()['mime'];
    }

}