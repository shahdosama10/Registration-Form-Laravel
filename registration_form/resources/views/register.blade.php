@extends('layout.master')
@section('title')
    Registration Form
@endsection
@section('content')
    <div class="container">
        <h1>{{ __('lang.registration_form') }}</h1>
        <form method="POST" class="input_form" enctype="multipart/form-data" onsubmit="validateForm(event);">
            @csrf

            <label for="full_name">{{ __('lang.full_name') }}:</label>
            <input type="text" id="full_name" name="full_name">
            <br>

            <label for="user_name">{{ __('lang.username') }}:</label>
            <input type="text" id="user_name" name="user_name">
            <br>

            <label for="birthdate">{{ __('lang.birthdate') }}:</label>
            <input type="date" id="birthdate" name="birthdate">
            <button type="button" onclick="checkActors()">{{ __('lang.check_actors') }}</button>
            <div id="actorsResult" class="actors-result" hidden></div>
            <br>

            <label for="phone">{{ __('lang.phone') }}:</label>
            <input type="tel" id="phone" name="phone">
            <br>

            <label for="address">{{ __('lang.address') }}:</label>
            <input type="text" id="address" name="address">
            <br>

            <label for="password">{{ __('lang.password') }}:</label>
            <input type="password" id="password" name="password">
            <br>

            <label for="password_confirmation">{{ __('lang.confirm_password') }}:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <br>

            <label for="email">{{ __('lang.email') }}:</label>
            <input type="email" id="email" name="email">
            <br>

            <label for="user_image">{{ __('lang.user_image') }}:</label>
            <input type="file" id="user_image" name="user_image" accept="image/*">
            <br>

            <input type="submit" value="{{ __('lang.register') }}">
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/indexScripts.js') }}"></script>


    <input type="hidden" id="registerRoute" value ="{{ route('register.register') }}">
@endsection