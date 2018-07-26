<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SubjectRequest as StoreRequest;
use App\Http\Requests\SubjectRequest as UpdateRequest;

/**
 * Class SubjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SubjectCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Subject');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/subjects');
        $this->crud->setEntityNameStrings('subject', 'subjects');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

       $this->crud->addColumns([
            [
               'name' => 'name', // The db column name
               'label' => "Subject", // Table column heading
            ],
            [
               'name' => 'icon', // The db column name
               'label' => "Subject Icon", // Table column heading
               'type' => 'image',
                // 'prefix' => 'folder/subfolder/',
                // optional width/height if 25px is not ok with you
                'height' => '30px',
                 'width' => '30px',
            ]
        ]);

        $this->crud->addFields([
            ['lable' => 'Subject Name', 'name' => 'name'],
            [   // Upload
                'name' => 'icon',
                'label' => 'Subject Icon',
                'type' => 'upload',
                'upload' => true,// if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            ],

        ]);

       $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);

        $this->crud->entry->slug = str_slug($this->crud->entry->name);
        $this->crud->entry->save();

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);

        $this->crud->entry->slug = str_slug($this->crud->entry->name);
        $this->crud->entry->save();

        return $redirect_location;
    }
}
