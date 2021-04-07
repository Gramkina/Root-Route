@push('css')
    <link rel="stylesheet" href="{{asset('css/language.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/language.js')}}"></script>
@endpush
<input id="languages" type="checkbox" hidden>
<div class="choose-language">
    <label for="languages">
        <div class="select-language">
            @if(App::isLocale('ru'))
                <img src="{{asset('img/flags/ru.svg')}}">RU
            @else
                <img src="{{asset('img/flags/en.svg')}}">EN
            @endif
        </div>
        <img src="{{asset('img/list-arrow.svg')}}">
    </label>
    <div class="option-language">
        <div class="option-language-element" lang="en">
            <div><img src="{{asset('img/flags/en.svg')}}">EN</div>
        </div>
        <div class="option-language-element" lang="ru">
            <div><img src="{{asset('img/flags/ru.svg')}}">RU</div>
        </div>
    </div>
</div>
