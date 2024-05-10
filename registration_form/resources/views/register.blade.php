<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="{{ asset('css/indexStyles.css') }}">
</head>
<body>
@include('layout.header')
    <div class="container">
        <h1>{{ __('registration_form') }}</h1>
        <form method="POST" class="input_form" action="{{ route('register') }}" enctype="multipart/form-data" onsubmit="return validateForm(event);">
            @csrf

            <label for="full_name">{{ __('full_name') }}:</label>
            <input type="text" id="full_name" name="full_name">
            <br>

            <label for="user_name">{{ __('username') }}:</label>
            <input type="text" id="user_name" name="user_name">
            <br>

            <label for="birthdate">{{ __('birthdate') }}:</label>
            <input type="date" id="birthdate" name="birthdate">
            <button type="button" onclick="checkActors()">{{ __('check_actors') }}</button>
            <div id="actorsResult" class="actors-result" hidden></div>
            <br>

            <label for="phone">{{ __('phone') }}:</label>
            <input type="tel" id="phone" name="phone">
            <br>

            <label for="address">{{ __('address') }}:</label>
            <input type="text" id="address" name="address">
            <br>

            <label for="password">{{ __('password') }}:</label>
            <input type="password" id="password" name="password">
            <br>

            <label for="password_confirmation">{{ __('confirm_password') }}:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <br>

            <label for="email">{{ __('email') }}:</label>
            <input type="email" id="email" name="email">
            <br>

            <label for="user_image">{{ __('user_image') }}:</label>
            <input type="file" id="user_image" name="user_image" accept="image/*">
            <br>

            <input type="submit" value="{{ __('register') }}">
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/indexScripts.js') }}"></script>
    @include('layout.footer')
</body>
</html>
