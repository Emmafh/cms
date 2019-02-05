<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Subject;

class SubjectControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->sub = new Subject;
        DB::beginTransaction();
        factory('App\Subject')->create([
                'name' => 'testtest',
                'code' => 'hahahahahahahahah',
                'description' => 'aaaaaaaa',
                'hidden' => 1,
                'course_id' => 999,
        ]);

    }
    public function tearDown()
    {
        DB::rollback();
        parent::tearDown();
    }

    public function testGetCourseSubjects()
    {
        $this->get('/courses/99999/subjects')
             ->seeJsonEquals([
                'msg'  => 'Resource not found',
             ]);	
        $response = $this->call('GET', '/courses/999/subjects');
        $this->assertEquals(200, $response->status());
        $this->assertEquals('hahahahahahahahah', $response->original['data'][0]['code']);
    }

    public function testGetSubjectDetails()
    {
        $this->get('/subjects/99999')
             ->seeJsonEquals([
                'msg'  => 'Resource not found',
             ]);	
        $response = $this->call('GET', '/subjects/9');
        $this->assertEquals(200, $response->status());
        $this->assertEquals('testtest', $response->original['data']['name']);
    }


    public function testDeleteSubject()
    {
        $response = $this->call('DELETE', '/subjects/9');
        $this->assertEquals(204, $response->status());
    }

    public function testHideSubject()
    {
        $response = $this->call('PATCH', '/subjects/9', ['hidden' => 3]);
        $this->assertEquals(400, $response->status());
        $response = $this->call('PATCH', '/subjects/9', ['hidden' => 2]);
        $this->assertEquals(200, $response->status());
        $response = $this->call('PATCH', '/subjects/9', ['hidden' => 1]);
        $this->assertEquals(200, $response->status());
    }

    public function testEditSubject()
    {
        $response = $this->call('PUT', '/subjects/9', ['name' => 'hehehe']);
        $this->assertEquals(200, $response->status());
        $this->assertEquals('hehehe', $response->original['data']['name']);
    }


}
