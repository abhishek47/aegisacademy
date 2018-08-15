<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CourseChapterSectionRequest as StoreRequest;
use App\Http\Requests\CourseChapterSectionRequest as UpdateRequest;

/**
 * Class CourseChapterSectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CourseChapterSectionCrudController extends CrudController
{
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

             [  // Select2
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
            ],


        ]);


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
