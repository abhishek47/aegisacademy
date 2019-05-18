<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\User;

class WikiProblem extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'problem_questions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['question', 'options', 'solution', 'level', 'hint', 'hint2', 'hint3', 'answer', 'wiki_id', 'is_subjective', 'subjective_answer'];
    // protected $hidden = [];
    // protected $dates = [];

    protected $appends = ['user_answer', 'is_solved_correct', 'solvings_count', 'solutions_count', 'is_blocked'];

    public function solutions()
    {
        return $this->hasMany(ProblemQuestionSolution::class);
    }

    public function wiki()
    {
        return $this->belongsTo(Wiki::class);
    }

    public function getOptionsAttribute()
    {
        return json_decode($this->attributes['options'], true);
    }

    public function solvers()
    {
        return $this->belongsToMany(User::class, 'user_problem_questions')->withTimeStamps()->withPivot(['answer', 'is_correct']);
    }

    public function getUserAnswerAttribute()
    {
        return auth()->user()->solvedProblemQuestions->contains($this) ? auth()->user()->solvedProblemQuestions()->where('problem_question_id', $this->id)->first()->pivot->answer  : null;
    }

    public function getIsSolvedCorrectAttribute()
    {
        return auth()->user()->solvedProblemQuestions->contains($this) ? auth()->user()->solvedProblemQuestions()->where('problem_question_id', $this->id)->first()->pivot->is_correct  : null;
    }

    public function getSolvingsCountAttribute()
    {
        return $this->solvers->count();
    }

     public function getSolutionsCountAttribute()
    {
        return $this->solutions->count();
    }

    public function getIsBlockedAttribute()
    {
        return !auth()->user()->is_premium && auth()->user()->daily_questions_count == 10;
    }

    public function editQuestion()
    {
        return '<a class="btn btn-xs btn-default"   href="/admin/wiki-problem-questions/' . $this->id . '/edit?wiki=' . $this->wiki->id . '" data-toggle="tooltip" title="Edit Question"><i class="fa fa-edit"></i> Edit</a>';
    }

     public function addQuestion()
    {
        return '<a class="btn btn-md btn-primary"   href="/admin/wiki-problem-questions/create?wiki=' . request('wiki') . '" data-toggle="tooltip" title="Add Question"><i class="fa fa-plus"></i> Add New Question</a>';
    }

    public function deleteQuestion()
    {


        return '<a href="javascript:void(0)"  class="btn btn-xs btn-default" onclick="deleteEntry(this)" data-route="/admin/wiki-problem-questions/' . $this->id  .'"class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-trash"></i> Delete</a><script>
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
