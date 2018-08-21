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
        return base64_encode($this->getImageBlob());
    }

    public function getImageInfo() : array
    {
        if(!$this->image) {
            return [];
        }
        return getimagesizefromstring($this->getImageBlob());
    }

    public function getImageMime()
    {
        return $this->getImageInfo()['mime'];
    }

    public function saveImageBlob($blob)
    {
        $this->image = gzdeflate($blob, 9);
    }

    public function getImageBlob()
    {
        return gzinflate($this->image);
    }

}