<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ActorsAPITest extends TestCase
{
    public function testGetActorsWithEmptyBirthdate(){
        $response = $this->get('/getActors');
        $response->assertStatus(400)->assertJson(['error' => 'Please provide a birthdate']);
        $response = $this->get('/getActors?birthdate=');
        $response->assertStatus(400)
                    ->assertJson([
                        'error' => 'Please provide a birthdate'
                    ]);
    
    } 


    public function testFetchActorsWithInvalidBirthdateFormat(){
        $response = $this->get('/getActors?month=15&day=35');
        $response->assertStatus(400)
                    ->assertJson([
                        'error' => 'Invalid birthdate format'
                    ]);
    }

    public function testFetchActorsWithApiRequestFailure()
    {
        Http::fake([
            '*' => Http::response([], 500)
        ]);

        $response = $this->get('/getActors?month=10&day=10');
        $response->assertStatus(500)
                 ->assertJson([
                     'error' => 'Failed to fetch data from the API. Please try again later.'
                 ]);
    }
}