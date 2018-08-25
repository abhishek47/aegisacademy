<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseChapter;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\CourseChapterSectionRequest as StoreRequest;
use App\Http\Requests\CourseChapterSectionRequest as UpdateRequest;

/**
 * Class CourseChapterSectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CourseChapterSectionCrudController extends CrudController
{
    protected $chapter;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\CourseChapterSection');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/course-chapter-sections');
        $this->crud->setEntityNameStrings('coursechaptersection', 'course_chapter_sections');

        $this->crud->backlink = config('backpack.base.route_prefix') . '/course-chapter-sections?course-chapter=' . request('course-chapter');

        $this->crud->addColumns([
            [
               'name' => 'title', // The db column name
               'label' => "Section Title", // Table column heading
            ],

        ]);

        $this->crud->addFields([
            [   // Upload
                'name' => 'banner',
                'label' => 'Section Icon',
                'type' => 'upload',
                'upload' => true,// if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            ],

            ['lable' => 'Section No.', 'name' => 'sequence', 'type' => 'number'],

            ['lable' => 'Section Title', 'name' => 'title'],

             [ // select_from_array
                'name' => 'content_type',
                'label' => "Content Type",
                'type' => 'select2_from_array',
                'options' => [0 => 'Article', 1 => 'Video', 2 => 'Quiz'],
                'allows_null' => false,
            ],

            ['lable' => 'Article', 'name' => 'body', 'type' => 'latex'],

            ['lable' => 'Video', 'name' => 'video', 'type' => 'video'],

             [  // Select2
               'label' => "Quiz",
               'type' => 'select2',
               'name' => 'problem_id', // the db column for the foreign key
               'entity' => 'problem', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Problem", // foreign key model
               'allows_null' => true
            ],




        ]);



        if(request()->has('course-chapter'))
        {
            $this->crud->addField([  // Select2
               'label' => "Course Chapter",
               'type' => 'hidden',
               'name' => 'course_chapter_id',
               'value' => request('course-chapter')

            ]);

             $this->chapter = CourseChapter::findOrFail(request('course-chapter'));

             $this->crud->addClause('where', 'course_chapter_id', '=', $this->chapter->id);

             $this->crud->setEntityNameStrings($this->chapter->title . ' | Section', $this->chapter->title . ' | Sections');

             $this->crud->headlink = config('backpack.base.route_prefix') . '/course-chapters?course=' . $this->chapter->course->id;
             $this->crud->headname = $this->chapter->title;

               $this->crud->addField([  // Select2
               'label' => "Course",
               'type' => 'hidden',
               'name' => 'course_id',
               'value' => $this->chapter->course->id

            ]);



            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions?problem=' . $this->problem->id);

        } else {
            $this->crud->addFields([   [  // Select2
               'label' => "Course",
               'type' => 'select2',
               'name' => 'course_id', // the db column for the foreign key
               'entity' => 'course', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Course", // foreign key model
               'allows_null' => false
            ],

            [  // Select2
               'label' => "Course Chapter",
               'type' => 'select2',
               'name' => 'course_chapter_id', // the db column for the foreign key
               'entity' => 'chapter', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\CourseChapter", // foreign key model
               'allows_null' => false
            ]]
            );
             $this->crud->setEntityNameStrings('Course Section', 'Course Sections');

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
                $redirectUrl = 'admin/course-chapter-sections/create?course-chapter=' . $this->crud->entry->chapter->id;
                break;
            case 'save_and_edit':
                $redirectUrl = 'admin/course-chapter-sections'.'/'.$itemId.'/edit?course-chapter='. $this->crud->entry->chapter->id;
                if (\Request::has('locale')) {
                    $redirectUrl .= '&locale='.\Request::input('locale');
                }
                break;
            case 'save_and_back':
            default:
                $redirectUrl = 'admin/course-chapter-sections?course-chapter=' . $this->crud->entry->chapter->id;
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
        $this->data['title'] = ucfirst(($this->chapter ? $this->chapter->title . ' --> ' : '') . $this->crud->entity_name_plural);

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
        return $redirect_location;
    }
}
