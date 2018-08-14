<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    CRUD::resource('problems', 'ProblemCrudController');
    CRUD::resource('problem-questions', 'ProblemQuestionCrudController');

    CRUD::resource('colors', 'ColorCrudController');

	CRUD::resource('wikis', 'WikiCrudController');
	CRUD::resource('wiki_categories', 'WikicategoryCrudController');

    CRUD::resource('subjects', 'SubjectCrudController');
    CRUD::resource('topics', 'TopicCrudController');

    CRUD::resource('books', 'BookCrudController');
    CRUD::resource('book-chapters', 'BookChapterCrudController');
    CRUD::resource('book-chapter-questions', 'BookChapterQuestionCrudController');

    CRUD::resource('courses', 'CourseCrudController');
    CRUD::resource('course-chapters', 'CourseChapterCrudController');


	CRUD::resource('quizzes', 'QuizCrudController');


	CRUD::resource('quiz_questions', 'QuizQuestionCrudController')->with(function(){
    // add extra routes to this resource
    Route::get('quiz_questions/quiz:{quiz}', 'QuizQuestionCrudController@get');

});

}); // this should be the absolute last line of this file


