<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/wiki', 'WikisController@index')->name('wikis');
Route::get('/wiki/category:{categoryId}', 'WikisController@index')->name('wikis.show');
Route::get('/wiki/{slug}', 'WikisController@show')->name('wikis.show');

Route::post('/wiki/update/{wiki}', 'WikisController@update')->name('wikis.update');

Route::get('/wiki/{wiki}/body', 'WikisController@getBody')->name('wikis.getBody');
Route::post('/wiki/{wiki}/body', 'WikisController@updateBody')->name('wikis.updateBody');


Route::post('/image/upload', 'ImageController@upload');


Route::get('/wiki/{wiki}/read', 'ReadWikiController@store');
Route::get('/wiki/{wiki}/unread', 'ReadWikiController@destroy');

Route::post('/wiki/{wiki}/rate', 'RateWikiController@store');

Route::get('/problems/{problem}', 'ProblemsController@get');
Route::get('/problem-question/{question}/question', 'ProblemQuestionsController@getQuestion');
Route::get('/problem-question/{question}/solutions', 'ProblemQuestionsController@getSolutions');
Route::post('/problem-question/{question}/answer', 'ProblemQuestionsController@answer');

Route::delete('/problem-question/solution/{solution}', 'ProblemQuestionSolutionsController@destroy');
Route::put('/problem-question/solution/{solution}', 'ProblemQuestionSolutionsController@update');
Route::post('/problem-question/solution/{solution}/upvote', 'ProblemQuestionSolutionsController@upvote');
Route::post('/problem-question/solution/{solution}/downvote', 'ProblemQuestionSolutionsController@downvote');
Route::post('/problem-question/{question}/solutions', 'ProblemQuestionSolutionsController@store');


Route::get('/discussions', 'DiscussionsController@index');
Route::get('/discussions/filter:{filter}', 'DiscussionsController@index');
Route::post('/discussions', 'DiscussionsController@store');
Route::get('/discussions/{discussion}', 'DiscussionsController@show');
Route::put('/discussions/{discussion}', 'DiscussionsController@update');
Route::get('/discussions/{discussion}/delete', 'DiscussionsController@destroy');

Route::post('/discussions/{discussion}/replies', 'ThreadRepliesController@store');


Route::post('/discussions/replies/{reply}', 'ThreadRepliesController@update');
Route::delete('/discussions/replies/{reply}', 'ThreadRepliesController@destroy');
Route::post('/discussions/replies/{reply}/like', 'ThreadRepliesController@like');
Route::post('/discussions/replies/{reply}/dislike', 'ThreadRepliesController@dislike');

Route::post('/discussions/replies/{reply}/best', 'ThreadRepliesController@best');


Route::get('/practice', 'PracticeController@index');
Route::get('/practice/{subject}/', 'PracticeController@subject');
Route::get('/practice/{subject}/topic:{topic}', 'PracticeController@topic');
Route::get('/practice/{subject}/topic:{topic}/problem:{problem}', 'PracticeController@problem');

Route::get('/books', 'BooksController@index');
Route::get('/books/{subject}', 'BooksController@subject');
Route::get('/books/{subject}/{slug}', 'BooksController@show');
Route::get('/books/{subject}/{slug}/chapter:{chapter}', 'BooksController@chapter');
Route::get('/book-chapter-question/{question}/question', 'BookChapterQuestionsController@getQuestion');
Route::post('/book-chapter-question/{question}/answer', 'BookChapterQuestionsController@answer');

Route::get('/book-chapter-question/{question}/solutions', 'BookChapterQuestionsController@getSolutions');
Route::delete('/book-chapter-question/solution/{solution}', 'BookChapterQuestionSolutionController@destroy');
Route::put('/book-chapter-question/solution/{solution}', 'BookChapterQuestionSolutionController@update');
Route::post('/book-chapter-question/solution/{solution}/upvote', 'BookChapterQuestionSolutionController@upvote');
Route::post('/book-chapter-question/solution/{solution}/downvote', 'BookChapterQuestionSolutionController@downvote');
Route::post('/book-chapter-question/{question}/solutions', 'BookChapterQuestionSolutionController@store');


Route::get('/profile', 'ProfileController@index');
Route::get('/profile/acheivements', 'ProfileController@acheivements');

