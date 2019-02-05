<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Get the list of all currently available courses.
$router->get('/courses', 'CourseController@index');

//Get the subjects under a course.
$router->get('/courses/{id}/subjects', 'SubjectController@getCourseSubjects');

//Get the details of one subject.
$router->get('/subjects/{id}', 'SubjectController@getSubjectDetails');

//Edit one subject.
$router->put('/subjects/{id}', 'SubjectController@editSubject');

//Delete one subject.
$router->delete('/subjects/{id}', 'SubjectController@deleteSubject');

//Hide or unhide one subject.
$router->patch('/subjects/{id}', 'SubjectController@hideSubject');
