<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TopicRequest as StoreRequest;
use App\Http\Requests\TopicRequest as UpdateRequest;

/**
 * Class TopicCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TopicCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('App\Models\Topic');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/topics');
        $this->crud->setEntityNameStrings('topic', 'topics');

         $this->crud->addColumns(['name']);

        $this->crud->addFields([
            ['lable' => 'Topic Name', 'name' => 'name'],
             [  // Select2
               'label' => "Subject",
               'type' => 'select2',
               'name' => 'subject_id', // the db column for the foreign key
               'entity' => 'subject', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Subject", // foreign key model
               'allows_null' => false
            ],
        ]);
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }
}
