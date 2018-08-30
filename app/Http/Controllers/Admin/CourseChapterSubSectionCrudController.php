<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subsection;
use App\Models\CourseChapter;
use App\Models\CourseChapterSection;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\CourseChapterSectionRequest as StoreRequest;
use App\Http\Requests\CourseChapterSectionRequest as UpdateRequest;

/**
 * Class CourseChapterSectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CourseChapterSubSectionCrudController extends CrudController
{
    protected $section;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Subsection');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/course-chapter-subsections');
        $this->crud->setEntityNameStrings('Subsection', 'Subsections');

        $this->crud->backlink = config('backpack.base.route_prefix') . '/course-chapter-subsections?course-section=' . request('course-section');

        $this->crud->addColumns([
            [
               'name' => 'title', // The db column name
               'label' => "Subsection Title", // Table column heading
            ],

        ]);

        $this->crud->addFields([
            [   // Upload
                'name' => 'banner',
                'label' => 'Subsection Icon',
                'type' => 'upload',
                'upload' => true,// if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            ],

            ['lable' => 'Subsection No.', 'name' => 'sequence', 'type' => 'number'],

            ['lable' => 'Subsection Title', 'name' => 'title'],

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



        if(request()->has('course-section'))
        {
            $this->crud->addField([  // Select2
               'label' => "Course Section",
               'type' => 'hidden',
               'name' => 'course_section_id',
               'value' => request('course-section')

            ]);

             $this->section = CourseChapterSection::findOrFail(request('course-section'));

             $this->crud->addClause('where', 'course_section_id', '=', $this->section->id);

             $this->crud->setEntityNameStrings($this->section->title . ' | Section', $this->section->title . ' | Sections');

             $this->crud->headlink = config('backpack.base.route_prefix') . '/course-chapter-subsections?course-section=' . $this->section->id;
             $this->crud->headname = $this->section->title;

               $this->crud->addField([  // Select2
               'label' => "Course Chapter",
               'type' => 'hidden',
               'name' => 'course_chapter_id',
               'value' => $this->section->chapter->id

            ]);

               $this->crud->addField([  // Select2
               'label' => "Course",
               'type' => 'hidden',
               'name' => 'course_id',
               'value' => $this->section->chapter->course->id

            ]);



            // $this->crud->setRoute(config('backpack.base.route_prefix') . '/problem-questions?problem=' . $this->problem->id);

        } else {


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
                $redirectUrl = 'admin/course-chapter-subsections/create?course-section=' . $this->crud->entry->section->id;
                break;
            case 'save_and_edit':
                $redirectUrl = 'admin/course-chapter-subsections'.'/'.$itemId.'/edit?course-section='. $this->crud->entry->section->id;
                if (\Request::has('locale')) {
                    $redirectUrl .= '&locale='.\Request::input('locale');
                }
                break;
            case 'save_and_back':
            default:
                $redirectUrl = 'admin/course-chapter-subsections?course-section=' . $this->crud->entry->section->id;
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
        $this->data['title'] = ucfirst(($this->section ? $this->section->title . ' --> ' : '') . $this->crud->entity_name_plural);

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
