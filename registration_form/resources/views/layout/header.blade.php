<header class="header">
    <h1>{{ __('lang.header') }}</h1>
    <div class="dropdown-container">
        <button class="dropdown-toggle" type="button" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
            {{app()->getLocale() == 'en' ? 'English' : 'العربية'}}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{url( app()->getLocale() == 'en' ? 'ar' : 'en')}}">{{app()->getLocale() == 'en' ? 'العربية' : 'English'}}</a>
        </div>
    </div>
</header>