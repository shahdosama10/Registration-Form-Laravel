<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserRegistration;
use Illuminate\Support\Facades\App;
use Illuminate\Http\JsonResponse;



class RegistrationController extends Controller
{
    public function register(Request $request)
{
    // Validate form data
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'user_name' => 'required|string|max:255|unique:users',
        'birthdate' => 'required|date',
        'phone' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
        'email' => 'required|string|email|max:255|unique:users',
        'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('user_image')) {
        $image = $request->file('user_image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads'), $imageName);
    }

    // Insert user data into database
    $user = new User();
    $user->full_name = $validatedData['full_name'];
    $user->user_name = $validatedData['user_name'];
    $user->birthdate = $validatedData['birthdate'];
    $user->phone = $validatedData['phone'];
    $user->address = $validatedData['address'];
    $user->password = bcrypt($validatedData['password']);
    $user->email = $validatedData['email'];
    $user->user_image = $imageName;

    // Attempt to save the user
    try {
        $user->save();
    } catch (\Illuminate\Database\QueryException $exception) {
        // Check for duplicate email or username errors
        if ($exception->errorInfo[1] == 1062) {
            if (strpos($exception->getMessage(), 'users_user_name_unique') !== false) {
                return new JsonResponse(['message' => 'Username already exists!'], 422);
            } elseif (strpos($exception->getMessage(), 'users_email_unique') !== false) {
                return new JsonResponse(['message' => 'Email already exists!'], 422);
            }
        }
        // If any other error occurs, return a generic error message
        return new JsonResponse(['message' => 'An error occurred while registering the user. Please try again later.'], 500);
    }

    // Send email notification
    Mail::to('sda805400@gmail.com')->send(new NewUserRegistration($validatedData['user_name']));

    return new JsonResponse(['message' =>'Registration successful!'], 200);
}

    



}
