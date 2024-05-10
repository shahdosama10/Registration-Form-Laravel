@extends('layout.master')
@section('title')
    Registration Form
@endsection
@section('content')
    <div class="container">
        <h1>{{ __('Laravel Registration Form') }}</h1>
        <form method="POST" class="input_form" action="{{ route('register') }}" enctype="multipart/form-data" onsubmit="return validateForm(event);">
            @csrf

            <label for="full_name">{{ __('Full Name') }}:</label>
            <input type="text" id="full_name" name="full_name">
            <br>

            <label for="user_name">{{ __('Username') }}:</label>
            <input type="text" id="user_name" name="user_name">
            <br>

            <label for="birthdate">{{ __('Birthdate') }}:</label>
            <input type="date" id="birthdate" name="birthdate">
            <button type="button" onclick="checkActors()">{{ __('Check Actors') }}</button>
            <div id="actorsResult" class="actors-result" hidden></div>
            <br>

            <label for="phone">{{ __('Phone') }}:</label>
            <input type="tel" id="phone" name="phone">
            <br>

            <label for="address">{{ __('Address') }}:</label>
            <input type="text" id="address" name="address">
            <br>

            <label for="password">{{ __('Password') }}:</label>
            <input type="password" id="password" name="password">
            <br>

            <label for="password_confirmation">{{ __('Confirm Password') }}:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <br>

            <label for="email">{{ __('Email') }}:</label>
            <input type="email" id="email" name="email">
            <br>

            <label for="user_image">{{ __('User Image') }}:</label>
            <input type="file" id="user_image" name="user_image" accept="image/*">
            <br>

            <input type="submit" value="{{ __('Register') }}">
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/indexScripts.js') }}"></script>
@endsection