<?php

namespace App\Http\Controllers\Admin;

use App\Models\Problem;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\ProblemQuestionRequest as StoreRequest;
use App\Http\Requests\ProblemQuestionRequest as UpdateRequest;

/**
 * Class ProblemQuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProblemQuestionCrudController extends CrudController
{

    protected $problem;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\ProblemQuestion');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions');

         $this->crud->backlink = config('backpack.base.route_prefix') . '/problem-questions?problem=' . request('problem');




        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumns(['question', 'level']);

        $this->crud->addFields([

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



            ['label' => 'Solution', 'name' => 'solution', 'type' => 'summernote', 'options' => ['height' => '200px']],

            ['label' => 'Hint', 'name' => 'hint', 'type' => 'summernote', 'options' => ['height' => '200px']],

            ['label' => 'Hint 2', 'name' => 'hint2', 'type' => 'summernote', 'options' => ['height' => '200px']],

            ['label' => 'Hint 3', 'name' => 'hint3', 'type' => 'summernote', 'options' => ['height' => '200px']],

            [ // select_from_array
                'name' => 'level',
                'label' => "Difficulty Level",
                'type' => 'select_from_array',
                'options' => [1, 2, 3, 4, 5],
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],



        ]);

        if(request()->has('problem'))
        {
            $this->crud->addField([  // Select2
               'label' => "Problem Set",
               'type' => 'hidden',
               'name' => 'problem_id',
               'value' => request('problem')

            ]);

            $this->problem = Problem::findOrFail(request('problem'));

            $this->crud->addClause('where', 'problem_id', '=', $this->problem->id);

             $this->crud->setEntityNameStrings($this->problem->title . ' | Question', $this->problem->title . ' | Questions');

             $this->crud->headlink = config('backpack.base.route_prefix') . '/problems';
             $this->crud->headname = $this->problem->title;



            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions?problem=' . $this->problem->id);

        } else {
            $this->crud->addField( [  // Select2
               'label' => "Problem Set",
               'type' => 'select2',
               'name' => 'problem_id', // the db column for the foreign key
               'entity' => 'problem', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Problem", // foreign key model
               'allows_null' => false
            ]
            );
             $this->crud->setEntityNameStrings('Question', 'Questions');

            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions');
        }

        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->crud->removeAllButtons();
        $this->crud->addButtonFromModelFunction('line', 'editQuestion', 'editQuestion', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'deleteQuestion', 'deleteQuestion', 'end');
        $this->crud->addButtonFromModelFunction('top', 'addQuestion', 'addQuestion', 'beginning');



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
                $redirectUrl = 'admin/problem-questions/create?problem=' . $this->crud->entry->problem->id;
                break;
            case 'save_and_edit':
                $redirectUrl = 'admin/problem-questions'.'/'.$itemId.'/edit?problem='. $this->crud->entry->problem->id;
                if (\Request::has('locale')) {
                    $redirectUrl .= '&locale='.\Request::input('locale');
                }
                break;
            case 'save_and_back':
            default:
                $redirectUrl = 'admin/problem-questions?problem=' . $this->crud->entry->problem->id;
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
        $this->data['title'] = ucfirst(($this->problem ? $this->problem->title . ' --> ' : '') . $this->crud->entity_name_plural);

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getListView(), $this->data);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
