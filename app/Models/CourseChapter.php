<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class CourseChapter extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'course_chapters';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title', 'description', 'course_id', 'sequence', 'banner', 'slug' , 'is_premium'];
    // protected $hidden = [];
    // protected $dates = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function sections()
    {
        return $this->hasMany(CourseChapterSection::class)->orderBy('sequence', "ASC");
    }

    public function finish()
    {
        $this->completed = 1;
        $this->save();

        auth()->user()->xp += 200;

        if($this->course->chapters()->where('completed', 0)->count() == 0)
        {
            auth()->user()->xp += 400;
        }

        auth()->user()->save();
    }

    public function isPreviousFinished(CourseChapter $previous)
    {
        return $previous->completed;
    }

    public function getIsBlockedAttribute()
    {
        return $this->is_premium && !auth()->user()->is_premium;
    }

   public function setBannerAttribute($value)
    {
        $attribute_name = "banner";
        $disk = "public";
        $destination_path = "uploads/courses/banners";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
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
