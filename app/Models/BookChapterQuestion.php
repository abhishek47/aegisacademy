<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class BookChapterQuestion extends Model
{
    use CrudTrait;

    protected $table = 'book_chapter_questions';
    protected $fillable = ['question', 'options', 'solution', 'level', 'hint', 'hint2', 'hint3', 'answer', 'chapter_id', 'is_subjective', 'subjective_answer'];

      protected $appends = ['user_answer', 'is_solved_correct', 'solvings_count', 'solutions_count'];

    public function solutions()
    {
        return $this->hasMany(BookChapterQuestionSolution::class);
    }

    public function chapter()
    {
        return $this->belongsTo(BookChapter::class);
    }

    public function getOptionsAttribute()
    {
        return json_decode($this->attributes['options'], true);
    }

     public function solvers()
    {
        return $this->belongsToMany(User::class, 'user_book_questions')->withTimeStamps()->withPivot(['answer', 'is_correct']);
    }

    public function getUserAnswerAttribute()
    {
        return auth()->user()->solvedBookQuestions->contains($this) ? auth()->user()->solvedBookQuestions()->where('book_chapter_question_id', $this->id)->first()->pivot->answer  : null;
    }

    public function getIsSolvedCorrectAttribute()
    {
        return auth()->user()->solvedBookQuestions->contains($this) ? auth()->user()->solvedBookQuestions()->where('book_chapter_question_id', $this->id)->first()->pivot->is_correct  : null;
    }

    public function getSolvingsCountAttribute()
    {
        return $this->solvers->count();
    }


    public function getSolutionsCountAttribute()
    {
        return 0;
    }

    public function edit()
    {
        return '<a class="btn btn-xs btn-default"   href="/admin/book-chapter-questions/' . $this->id . '/edit?book-chapter=' . $this->chapter->id . '" data-toggle="tooltip" title="Edit Question"><i class="fa fa-edit"></i> Edit</a>';
    }

     public function add()
    {
        return '<a class="btn btn-md btn-primary"   href="/admin/book-chapter-questions/create?book-chapter=' . request('book-chapter') . '" data-toggle="tooltip" title="Add Question"><i class="fa fa-plus"></i> Add New Question</a>';
    }

    public function delete()
    {


        return '<a href="javascript:void(0)"  class="btn btn-xs btn-default" onclick="deleteEntry(this)" data-route="/admin/book-chapter-questions/' . $this->id  .'"class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> Delete</a><script>
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
