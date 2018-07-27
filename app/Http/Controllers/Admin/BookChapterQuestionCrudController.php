<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BookChapterQuestionRequest as StoreRequest;
use App\Http\Requests\BookChapterQuestionRequest as UpdateRequest;

/**
 * Class BookChapterQuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BookChapterQuestionCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\BookChapterQuestion');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/book-chapter-questions');
        $this->crud->setEntityNameStrings('Book Chapter Question', 'Book Chapter Questions');

       $this->crud->addColumns(['question', 'level']);

        $this->crud->addFields([
             [  // Select2
               'label' => "Book Chapter",
               'type' => 'select2',
               'name' => 'chapter_id', // the db column for the foreign key
               'entity' => 'chapter', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\BookChapter", // foreign key model
               'allows_null' => false
            ],

             ['label' => 'Question', 'name' => 'question', 'type' => 'latex'],

            [ // Table
                'name' => 'options',
                'label' => 'Options',
                'type' => 'table',
                'entity_singular' => 'option', // used on the "Add X" button
                'columns' => [
                    'text' => 'Value',
                ],
                'max' => 5, // maximum rows allowed in the table
                'min' => 0 // minimum rows allowed in the table
            ],

            ['label' => 'Answer Index ( Give option number. For ex. if option 1 is answer then enter 1 )', 'name' => 'answer', 'type' => 'number'],



            ['label' => 'Solution', 'name' => 'solution', 'type' => 'summernote'],

            ['label' => 'Hint', 'name' => 'hint', 'type' => 'summernote'],

            [ // select_from_array
                'name' => 'level',
                'label' => "Difficulty Level",
                'type' => 'select_from_array',
                'options' => [1, 2, 3, 4, 5],
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],



        ]);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
         $this->crud->entry->book_id = $this->crud->entry->chapter->book_id;
         $this->crud->entry->save();
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
       $this->crud->entry->book_id = $this->crud->entry->chapter->book_id;
         $this->crud->entry->save();
        return $redirect_location;
    }
}
