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

    public function manageSections()
    {
        return '<a class="btn btn-xs btn-primary"   href="/admin/course-chapter-sections?course-chapter=' . $this->id . '" data-toggle="tooltip" title="Manage Sections">Manage Sections</a>';
    }

     public function edit()
    {
        return '<a class="btn btn-xs btn-default"   href="/admin/course-chapters/' . $this->id . '/edit?course=' . $this->course->id . '" data-toggle="tooltip" title="Edit Chapter"><i class="fa fa-edit"></i> Edit</a>';
    }

     public function add()
    {
        return '<a class="btn btn-md btn-primary"   href="/admin/course-chapters/create?course=' . request('course') . '" data-toggle="tooltip" title="Add Chapter"><i class="fa fa-plus"></i> Add New Chapter</a>';
    }

    public function delete()
    {


        return '<a href="javascript:void(0)"  class="btn btn-xs btn-default" onclick="deleteEntry(this)" data-route="/admin/course-chapters/' . $this->id  .'"class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> Delete</a><script>
    if (typeof deleteEntry != \'function\') {
      $("[data-button-type=delete]").unbind(\'click\');

      function deleteEntry(button) {
          // ask for confirmation before deleting an item
          // e.preventDefault();
          var button = $(button);
          var route = button.attr(\'data-route\');
          var row = $("#crudTable a[data-route=\'"+route+"\']").parentsUntil(\'tr\').parent();

          if (confirm("Are you sure you want to delete this item?") == true) {
              $.ajax({
                  url: route,
                  type: \'DELETE\',
                  success: function(result) {
                      // Show an alert with the result
                      new PNotify({
                          title: "Item Deleted",
                          text: "The item has been deleted successfully.",
                          type: "success"
                      });

                      // Hide the modal, if any
                      $(\'.modal\').modal(\'hide\');

                      // Remove the row from the datatable
                      row.remove();
                  },
                  error: function(result) {
                      // Show an alert with the result
                      new PNotify({
                          title: "NOT deleted",
                          text: "There&#039;s been an error. Your item might not have been deleted.",
                          type: "warning"
                      });
                  }
              });
          } else {
              // Show an alert telling the user we don\'t know what went wrong
              new PNotify({
                  title: "Not deleted",
                  text: "Nothing happened. Your item is safe.",
                  type: "info"
              });
          }
      }
    }

    // make it so that the function above is run after each DataTable draw event
    // crud.addFunctionToDataTablesDrawEventQueue(\'deleteEntry\');
</script>';
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
