<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BookChapterRequest as StoreRequest;
use App\Http\Requests\BookChapterRequest as UpdateRequest;

/**
 * Class BookChapterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BookChapterCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\BookChapter');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/book-chapters');
        $this->crud->setEntityNameStrings('Book Chapter', 'Book Chapters');

        $this->crud->addColumns(['name', 'bookName']);

        $this->crud->addFields([
            ['label' => 'Chapter Name', 'name' => 'name'],
          //  ['lable' => 'Body', 'name' => 'body', 'type' => 'latex'],
            [  // Select2
               'label' => "Book",
               'type' => 'select2',
               'name' => 'book_id', // the db column for the foreign key
               'entity' => 'book', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Book", // foreign key model
               'allows_null' => false
            ],
        ]);

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
