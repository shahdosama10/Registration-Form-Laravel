<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\NewUserRegistered;
use Illuminate\Http\UploadedFile;

class EmailNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function email_notification_sent_on_registration()
    {
        Mail::fake();

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

        Mail::assertSent(NewUserRegistered::class, function ($mail) {
            return $mail->hasTo('otpsender89@gmail.com');
        });
    }
}
