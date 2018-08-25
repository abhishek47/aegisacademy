<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Book extends Model
{
    use CrudTrait;

    protected $table = 'books';
    protected $fillable = ['title', 'description', 'subject_id', 'topic_id', 'image', 'author', 'is_premium'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function chapters()
    {
        return $this->hasMany(BookChapter::class);
    }

    public function questions()
    {
        return $this->hasMany(BookChapterQuestion::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "public";
        $destination_path = "uploads/books/posters";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

     public function getIsOngoingAttribute()
    {
        foreach ($this->questions()->pluck('id') as $key => $id) {
            if(auth()->user()->solvedBookQuestions->contains($id)){
              return true;
            }
        }
        return false;
    }

    public function getIsCompleteAttribute()
    {
        foreach ($this->questions()->pluck('id') as $key => $id) {
          if(!auth()->user()->solvedBookQuestions->contains($id)){
            return false;
          }
        }
        return true;
    }

    public function getIsBlockedAttribute()
    {
        return $this->is_premium && !auth()->user()->is_premium;
    }

    public function manageChapters()
    {
        return '<a class="btn btn-xs btn-primary"   href="/admin/book-chapters?book=' . $this->id . '" data-toggle="tooltip" title="Manage Chapters">Manage Chapters</a>';
    }

    /*
    }
    |--------------------------------------------------------------------------
    | Methods for storing uploaded files (used in CRUD).
    |--------------------------------------------------------------------------
    */

    /**
     * Handle file upload and DB storage for a file:
     * - on CREATE
     *     - stores the file at the destination path
     *     - generates a name
     *     - stores the full path in the DB;
     * - on UPDATE
     *     - if the value is null, deletes the file and sets null in the DB
     *     - if the value is different, stores the different file and updates DB value.
     *
     * @param  [type] $value            Value for that column sent from the input.
     * @param  [type] $attribute_name   Model attribute name (and column in the db).
     * @param  [type] $disk             Filesystem disk used to store files.
     * @param  [type] $destination_path Path in disk where to store the files.
     */
    public function uploadFileToDisk($value, $attribute_name, $disk, $destination_path)
    {
        $request = \Request::instance();

        // if a new file is uploaded, delete the file from the disk
        if ($request->hasFile($attribute_name) &&
            $this->{$attribute_name} &&
            $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if the file input is empty, delete the file from the disk
        if (is_null($value) && $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name) && $request->file($attribute_name)->isValid()) {
            // 1. Generate a new file name
            $file = $request->file($attribute_name);
            $new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();

            // 2. Move the new file to the correct path
            $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

            // 3. Save the complete path to the database
            $this->attributes[$attribute_name] = 'storage/' . $file_path;
        }
    }

}
