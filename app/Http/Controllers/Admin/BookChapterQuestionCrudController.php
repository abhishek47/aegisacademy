<?php

namespace App\Http\Controllers\Admin;

use App\Models\BookChapter;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\BookChapterQuestionRequest as StoreRequest;
use App\Http\Requests\BookChapterQuestionRequest as UpdateRequest;

/**
 * Class BookChapterQuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BookChapterQuestionCrudController extends CrudController
{

    protected $chapter;

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

        $this->crud->backlink = config('backpack.base.route_prefix') . '/book-chapter-questions?book-chapter=' . request('book-chapter');

       $this->crud->addColumns(['question', 'level']);

        $this->crud->addFields([


             ['label' => 'Question', 'name' => 'question', 'type' => 'latex'],

            [ // select_from_array
                'name' => 'is_subjective',
                'label' => "Subjective Question",
                'type' => 'select_from_array',
                'options' => [0 => 'No', 1 => 'Yes'],
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],

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

            ['label' => 'Answer Index ( Give option number. For ex. if option 1 is answer then enter 1. Leave Blank for subjective question)', 'name' => 'answer', 'type' => 'number'],

            ['label' => 'Answer for subjective question ( Leave blank for objective )', 'name' => 'subjective_answer'],

            ['label' => 'Solution', 'name' => 'solution', 'type' => 'summernote'],

            ['label' => 'Hint', 'name' => 'hint', 'type' => 'summernote'],

            ['label' => 'Hint 2', 'name' => 'hint2', 'type' => 'summernote'],

            ['label' => 'Hint 3', 'name' => 'hint3', 'type' => 'summernote'],

            [ // select_from_array
                'name' => 'level',
                'label' => "Difficulty Level",
                'type' => 'select_from_array',
                'options' => [1, 2, 3, 4, 5],
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],



        ]);


        if(request()->has('book-chapter'))
        {
            $this->crud->addField([  // Select2
               'label' => "Chapter",
               'type' => 'hidden',
               'name' => 'chapter_id',
               'value' => request('book-chapter')

            ]);

             $this->chapter = BookChapter::findOrFail(request('book-chapter'));

             $this->crud->addClause('where', 'chapter_id', '=', $this->chapter->id);

             $this->crud->setEntityNameStrings($this->chapter->name . ' | Question', $this->chapter->name . ' | Questions');

             $this->crud->headlink = config('backpack.base.route_prefix') . '/book-chapters?book=' . $this->chapter->book->id;
             $this->crud->headname = $this->chapter->name;



            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions?problem=' . $this->problem->id);

        } else {
            $this->crud->addField(  [  // Select2
               'label' => "Book Chapter",
               'type' => 'select2',
               'name' => 'chapter_id', // the db column for the foreign key
               'entity' => 'chapter', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\BookChapter", // foreign key model
               'allows_null' => false
            ]
            );
             $this->crud->setEntityNameStrings('Question', 'Questions');

            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions');
        }




        $this->crud->removeAllButtons();
        $this->crud->addButtonFromModelFunction('line', 'edit', 'edit', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'delete', 'delete', 'end');
        $this->crud->addButtonFromModelFunction('top', 'add', 'add', 'beginning');



    }

     /**
     * Redirect to the correct URL, depending on which save action has been selected.
     * @param  [type] $itemId [description]
     * @return [type]         [description]
     */
    public function performSaveAction($itemId = null)
    {
        $saveAction = \Request::input('save_action', config('backpack.crud.default_save_action', 'save_and_back'));
        $itemId = $itemId ? $itemId : \Request::input('id');

        switch ($saveAction) {
            case 'save_and_new':
                $redirectUrl = 'admin/book-chapter-questions/create?book-chapter=' . $this->crud->entry->chapter->id;
                break;
            case 'save_and_edit':
                $redirectUrl = 'admin/book-chapter-questions'.'/'.$itemId.'/edit?book-chapter='. $this->crud->entry->chapter->id;
                if (\Request::has('locale')) {
                    $redirectUrl .= '&locale='.\Request::input('locale');
                }
                break;
            case 'save_and_back':
            default:
                $redirectUrl = 'admin/book-chapter-questions?book-chapter=' . $this->crud->entry->chapter->id;
                break;
        }

        return \Redirect::to($redirectUrl);
    }

 /**
     * Display all rows in the database for this entity.
     *
     * @return Response
     */
    public function index()
    {
        $this->crud->hasAccessOrFail('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = ucfirst(($this->chapter ? $this->chapter->name . ' --> ' : '') . $this->crud->entity_name_plural);

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getListView(), $this->data);
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
