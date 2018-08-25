<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\BookChapterRequest as StoreRequest;
use App\Http\Requests\BookChapterRequest as UpdateRequest;

/**
 * Class BookChapterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BookChapterCrudController extends CrudController
{

    protected $book;

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

        $this->crud->backlink = config('backpack.base.route_prefix') . '/book-chapters?book=' . request('book');

        $this->crud->addColumns(['name', 'bookName']);

        $this->crud->addFields([
            ['label' => 'Chapter Name', 'name' => 'name'],
          //  ['lable' => 'Body', 'name' => 'body', 'type' => 'latex'],

        ]);

        if(request()->has('book'))
        {
            $this->crud->addField([  // Select2
               'label' => "Book",
               'type' => 'hidden',
               'name' => 'book_id',
               'value' => request('book')

            ]);

            $this->book = Book::findOrFail(request('book'));

            $this->crud->addClause('where', 'book_id', '=', $this->book->id);

             $this->crud->setEntityNameStrings($this->book->title . ' | Chapter', $this->book->title . ' | Chapters');

             $this->crud->headlink = config('backpack.base.route_prefix') . '/books';
             $this->crud->headname = $this->book->title;



            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions?problem=' . $this->problem->id);

        } else {
            $this->crud->addField( [  // Select2
               'label' => "Book",
               'type' => 'select2',
               'name' => 'book_id', // the db column for the foreign key
               'entity' => 'book', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Book", // foreign key model
               'allows_null' => false
            ]
            );
             $this->crud->setEntityNameStrings('Book Chapter', 'Book Chapters');

            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions');
        }
        $this->crud->removeAllButtons();
        $this->crud->addButtonFromModelFunction('line', 'edit', 'edit', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'delete', 'delete', 'end');
        $this->crud->addButtonFromModelFunction('top', 'add', 'add', 'beginning');

         $this->crud->addButtonFromModelFunction('line', 'manageQuestions', 'manageQuestions', 'end');



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
                $redirectUrl = 'admin/book-chapters/create?book=' . $this->crud->entry->book->id;
                break;
            case 'save_and_edit':
                $redirectUrl = 'admin/book-chapters'.'/'.$itemId.'/edit?book='. $this->crud->entry->book->id;
                if (\Request::has('locale')) {
                    $redirectUrl .= '&locale='.\Request::input('locale');
                }
                break;
            case 'save_and_back':
            default:
                $redirectUrl = 'admin/book-chapters?book=' . $this->crud->entry->book->id;
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
        $this->data['title'] = ucfirst(($this->book ? $this->book->title . ' --> ' : '') . $this->crud->entity_name_plural);

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
