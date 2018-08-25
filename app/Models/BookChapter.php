<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use App\Models\BookChapterQuestion;
use Illuminate\Database\Eloquent\Model;

class BookChapter extends Model
{
    use CrudTrait;

    protected $table = 'book_chapters';
    protected $fillable = ['name', 'book_id', 'description'];

    protected $levels = ['Beginner', 'Intermidiate', 'Advance'];


   protected $with = ['questions'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }


   public function questions()
   {
       return $this->hasMany(BookChapterQuestion::class, 'chapter_id');
   }

    public function getBookNameAttribute()
    {
        return $this->book->title;
    }

    public function manageQuestions()
    {
        return '<a class="btn btn-xs btn-primary"   href="/admin/book-chapter-questions?book-chapter=' . $this->id . '" data-toggle="tooltip" title="Manage Questions">Manage Questions</a>';
    }

     public function edit()
    {
        return '<a class="btn btn-xs btn-default"   href="/admin/book-chapters/' . $this->id . '/edit?book=' . $this->book->id . '" data-toggle="tooltip" title="Edit Chapter"><i class="fa fa-edit"></i> Edit</a>';
    }

     public function add()
    {
        return '<a class="btn btn-md btn-primary"   href="/admin/book-chapters/create?book=' . request('book') . '" data-toggle="tooltip" title="Add Chapter"><i class="fa fa-plus"></i> Add New Chapter</a>';
    }

    public function delete()
    {


        return '<a href="javascript:void(0)"  class="btn btn-xs btn-default" onclick="deleteEntry(this)" data-route="/admin/book-chapters/' . $this->id  .'"class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> Delete</a><script>
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



}
