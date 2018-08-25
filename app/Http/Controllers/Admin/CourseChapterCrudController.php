<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\CourseChapterRequest as StoreRequest;
use App\Http\Requests\CourseChapterRequest as UpdateRequest;

/**
 * Class CourseChapterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CourseChapterCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\CourseChapter');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/course-chapters');
        $this->crud->setEntityNameStrings('coursechapter', 'course_chapters');

        $this->crud->backlink = config('backpack.base.route_prefix') . '/course-chapters?book=' . request('course');

        $this->crud->addColumns([
            [
               'name' => 'title', // The db column name
               'label' => "Chapter Title", // Table column heading
            ],

        ]);

        $this->crud->addFields([
            [   // Upload
                'name' => 'banner',
                'label' => 'Chapter Icon',
                'type' => 'upload',
                'upload' => true,// if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            ],

            ['lable' => 'Chapter No.', 'name' => 'sequence', 'type' => 'number'],

            ['lable' => 'Chapter Name', 'name' => 'title'],

            ['lable' => 'Chapter Description', 'name' => 'description', 'type' => 'textarea'],



            [ // select_from_array
                'name' => 'is_premium',
                'label' => "Is Premium Content",
                'type' => 'select_from_array',
                'options' => [0 => 'No', 1 => 'Yes'],
                'allows_null' => false,
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],


        ]);

        if(request()->has('course'))
        {
            $this->crud->addField([  // Select2
               'label' => "Course",
               'type' => 'hidden',
               'name' => 'course_id',
               'value' => request('course')

            ]);

            $this->course = Course::findOrFail(request('course'));

            $this->crud->addClause('where', 'course_id', '=', $this->course->id);

             $this->crud->setEntityNameStrings($this->course->title . ' | Chapter', $this->course->title . ' | Chapters');

             $this->crud->headlink = config('backpack.base.route_prefix') . '/courses';
             $this->crud->headname = $this->course->title;



            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions?problem=' . $this->problem->id);

        } else {
            $this->crud->addField( [  // Select2
               'label' => "Course",
               'type' => 'select2',
               'name' => 'course_id', // the db column for the foreign key
               'entity' => 'course', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Course", // foreign key model
               'allows_null' => true
            ]
            );
             $this->crud->setEntityNameStrings('Course Chapter', 'Course Chapters');

            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions');
        }
        $this->crud->removeAllButtons();
        $this->crud->addButtonFromModelFunction('line', 'edit', 'edit', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'delete', 'delete', 'end');
        $this->crud->addButtonFromModelFunction('top', 'add', 'add', 'beginning');

         $this->crud->addButtonFromModelFunction('line', 'manageSections', 'manageSections', 'end');



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
                $redirectUrl = 'admin/course-chapters/create?book=' . $this->crud->entry->course->id;
                break;
            case 'save_and_edit':
                $redirectUrl = 'admin/course-chapters'.'/'.$itemId.'/edit?course='. $this->crud->entry->course->id;
                if (\Request::has('locale')) {
                    $redirectUrl .= '&locale='.\Request::input('locale');
                }
                break;
            case 'save_and_back':
            default:
                $redirectUrl = 'admin/course-chapters?course=' . $this->crud->entry->course->id;
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
        $this->data['title'] = ucfirst(($this->course ? $this->course->title . ' --> ' : '') . $this->crud->entity_name_plural);

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getListView(), $this->data);
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
         $this->crud->entry->slug = str_slug($this->crud->entry->title);
        $this->crud->entry->save();
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        $this->crud->entry->slug = str_slug($this->crud->entry->title);
        $this->crud->entry->save();
        return $redirect_location;
    }
}
