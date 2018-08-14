<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CourseRequest as StoreRequest;
use App\Http\Requests\CourseRequest as UpdateRequest;

/**
 * Class CourseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CourseCrudController extends CrudController
{
    public function setup()
    {

        $this->crud->setModel('App\Models\Course');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/courses');
        $this->crud->setEntityNameStrings('course', 'courses');


        $this->crud->addColumns([
            [
               'name' => 'title', // The db column name
               'label' => "Course", // Table column heading
            ],

        ]);

        $this->crud->addFields([
            [   // Upload
                'name' => 'banner',
                'label' => 'Course Icon',
                'type' => 'upload',
                'upload' => true,// if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            ],

             [  // Select2
               'label' => "Color",
               'type' => 'select2',
               'name' => 'color_id', // the db column for the foreign key
               'entity' => 'color', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Color", // foreign key model
               'allows_null' => false
            ],

            ['lable' => 'Course Title', 'name' => 'title'],
            ['lable' => 'Course Description', 'name' => 'description', 'type' => 'textarea'],
            [ // select_from_array
                'name' => 'level',
                'label' => "Difficulty Level",
                'type' => 'select2_from_array',
                'options' => [0 => 'Beginner', 1 => 'Intermediate', 2 => 'Advance'],
                'allows_null' => false,
            ],
             [  // Select2
               'label' => "Subject",
               'type' => 'select2',
               'name' => 'subject_id', // the db column for the foreign key
               'entity' => 'subject', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Subject", // foreign key model
               'allows_null' => true
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
