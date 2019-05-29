<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Models\Wiki;
use App\Http\Requests\WikiProblemRequest as StoreRequest;
use App\Http\Requests\WikiProblemRequest as UpdateRequest;

/**
 * Class WikiProblemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WikiProblemCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\WikiProblem');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/wikiproblem');
        $this->crud->setEntityNameStrings('wikiproblem', 'wiki_problems');

        $this->crud->setRoute(config('backpack.base.route_prefix') . '/wiki-problem-questions');

        $this->crud->backlink = config('backpack.base.route_prefix') . '/wiki-problem-questions?wiki=' . request('wiki');




        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

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

            ['label' => 'Solution', 'name' => 'solution', 'type' => 'latex'],

            ['label' => 'Hint', 'name' => 'hint', 'type' => 'latex'],

            ['label' => 'Hint 2', 'name' => 'hint2', 'type' => 'latex'],

            ['label' => 'Hint 3', 'name' => 'hint3', 'type' => 'latex'],

            [ // select_from_array
                'name' => 'level',
                'label' => "Difficulty Level",
                'type' => 'select_from_array',
                'options' => [1, 2, 3, 4, 5],
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],



        ]);

        if(request()->has('wiki'))
        {
            $this->crud->addField([  // Select2
               'label' => "Wiki",
               'type' => 'hidden',
               'name' => 'wiki_id',
               'value' => request('wiki')

            ]);

            $this->wiki = Wiki::findOrFail(request('wiki'));

            $this->crud->addClause('where', 'wiki_id', '=', $this->wiki->id);

             $this->crud->setEntityNameStrings($this->wiki->title . ' | Question', $this->wiki->title . ' | Questions');

             $this->crud->headlink = config('backpack.base.route_prefix') . '/wikis';
             $this->crud->headname = $this->wiki->title;



            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions?problem=' . $this->problem->id);

        } else {
            $this->crud->addField( [  // Select2
               'label' => "Problem Set",
               'type' => 'select2',
               'name' => 'wiki_id', // the db column for the foreign key
               'entity' => 'wiki', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Wiki", // foreign key model
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
                $redirectUrl = 'admin/wiki-problem-questions/create?wiki=' . $this->crud->entry->wiki->id;
                break;
            case 'save_and_edit':
                $redirectUrl = 'admin/wiki-problem-questions'.'/'.$itemId.'/edit?wiki='. $this->crud->entry->wiki->id;
                if (\Request::has('locale')) {
                    $redirectUrl .= '&locale='.\Request::input('locale');
                }
                break;
            case 'save_and_back':
                $redirectUrl = 'admin/wiki-problem-questions'.'/'.$itemId.'/edit?wiki='. $this->crud->entry->wiki->id;
                if (\Request::has('locale')) {
                    $redirectUrl .= '&locale='.\Request::input('locale');
                }
            default:
                $redirectUrl = 'admin/wiki-problem-questions?wiki=' . $this->crud->entry->wiki->id;
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
        $this->data['title'] = ucfirst((request('wiki') ? $this->wiki->id . ' --> ' : '') . $this->crud->entity_name_plural);

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
