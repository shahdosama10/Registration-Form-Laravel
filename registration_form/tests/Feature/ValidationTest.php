<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    /** @test */
    public function required_fields_should_not_be_empty()
    {
        $response = $this->post('/register', [
            // empty fields
        ]);

        $response->assertSessionHasErrors([
            'full_name', 'user_name', 'birthdate', 'phone', 'address', 'password', 'email', 'user_image'
        ]);
    }
}
