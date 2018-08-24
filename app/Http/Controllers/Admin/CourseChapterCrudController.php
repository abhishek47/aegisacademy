<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
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

             [  // Select2
               'label' => "Course",
               'type' => 'select2',
               'name' => 'course_id', // the db column for the foreign key
               'entity' => 'course', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Course", // foreign key model
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
