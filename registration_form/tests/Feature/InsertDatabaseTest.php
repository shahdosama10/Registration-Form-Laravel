<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;


class InsertDatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Insert_In_Database(): void
    {
        $response = $this->post('/register', [
            'full_name' => 'John Doe',
            'user_name' => 'johndoe',
            'birthdate' => '1990-01-01',
            'phone' => '123456789',
            'address' => '123 Main St, City',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => 'johndoe@example.com',
            'user_image' => UploadedFile::fake()->image('avatar.jpg')
        ]);



        $this->assertDatabaseHas('users', ['user_name'=>'johndoe','email' => 
        'johndoe@example.com']);
    }
}
