<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BookRequest as StoreRequest;
use App\Http\Requests\BookRequest as UpdateRequest;

/**
 * Class BookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BookCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Book');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/books');
        $this->crud->setEntityNameStrings('book', 'books');


        $this->crud->addColumns([
            [
               'name' => 'image', // The db column name
               'label' => "Book Poster", // Table column heading
               'type' => 'image',
                // 'prefix' => 'folder/subfolder/',
                // optional width/height if 25px is not ok with you
                'height' => '80px',
                 'width' => '80px',
            ],
            [
               'name' => 'title', // The db column name
               'label' => "Title", // Table column heading
            ]

        ]);

        $this->crud->addFields([
            [   // Upload
                'name' => 'image',
                'label' => 'Book Poster',
                'type' => 'upload',
                'upload' => true,// if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            ],

            ['label' => 'Book Title', 'name' => 'title'],

            ['label' => 'Description', 'name' => 'description', 'type' => 'textarea'],

            ['label' => 'Author/Publication', 'name' => 'author'],

             [  // Select2
               'label' => "Subject",
               'type' => 'select2',
               'name' => 'subject_id', // the db column for the foreign key
               'entity' => 'subject', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Subject", // foreign key model
               'allows_null' => false
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


            [ // select_from_array
                'name' => 'is_premium',
                'label' => "Is Premium Content",
                'type' => 'select_from_array',
                'options' => [0 => 'No', 1 => 'Yes'],
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],
        ]);

        $this->crud->addButtonFromModelFunction('line', 'manageChapters', 'manageChapters', 'end');


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
