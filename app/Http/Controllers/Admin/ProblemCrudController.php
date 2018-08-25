<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProblemRequest as StoreRequest;
use App\Http\Requests\ProblemRequest as UpdateRequest;

/**
 * Class ProblemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProblemCrudController extends CrudController
{
    public function setup()
    {

        $this->crud->setModel('App\Models\Problem');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/problems');
        $this->crud->setEntityNameStrings('problem', 'problems');



        $this->crud->addColumns(['title']);

        $this->crud->addFields([
            ['lable' => 'Title', 'name' => 'title'],
            ['lable' => 'Problems Description', 'name' => 'description', 'type' => 'textarea'],

             [ // select_from_array
                'name' => 'level',
                'label' => "Difficulty Level",
                'type' => 'select2_from_array',
                'options' => [0 => 'Beginner', 1 => 'Intermediate', 2 => 'Advance'],
                'allows_null' => false,
            ],
             [  // Select2
               'label' => "Subject",
               'type' => 'select2',
               'name' => 'subject_id', // the db column for the foreign key
               'entity' => 'subject', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Subject", // foreign key model
               'allows_null' => true
            ],

             [  // Select2
               'label' => "Topic",
               'type' => 'select2',
               'name' => 'topic_id', // the db column for the foreign key
               'entity' => 'topic', // the method that defines the relationship in your Model
               'attribute' => 'nameWithSubject', // foreign key attribute that is shown to user
               'model' => "App\Models\Topic", // foreign key model
               'allows_null' => true
            ],

        ]);


        $this->crud->addButtonFromModelFunction('line', 'manageQuestions', 'manageQuestions', 'end');


    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        $this->crud->entry->slug = str_slug($this->crud->entry->title);
        $this->crud->entry->save();
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
       $this->crud->entry->slug = str_slug($this->crud->entry->title);
        $this->crud->entry->save();
        return $redirect_location;
    }
}
