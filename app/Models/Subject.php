<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Subject extends Model
{
    use CrudTrait;

    protected $table = 'subjects';
    protected $fillable = ['name', 'icon', 'slug'];

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('name');
    }

    public function setIconAttribute($value)
    {
        $attribute_name = "icon";
        $disk = "public";
        $destination_path = "uploads/subjects/icons";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
