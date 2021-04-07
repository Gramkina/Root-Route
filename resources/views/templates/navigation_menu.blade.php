@push('css')
    <link rel="stylesheet" href="{{asset('css/body/navigation_menu.css')}}">
@endpush

<div class="navigation_menu_logo">
    <img class="navigation_menu_logo_img" src="{{asset('img/logo.svg')}}" alt="Logo">
    Root<br>Route
</div>

<?php
    $navigationMenu = json_decode(\Illuminate\Support\Facades\Storage::disk('local')->get(\Illuminate\Support\Facades\Auth::user()->role === 'admin' ? 'navigation_menu.json' : 'navigation_menu.json'), true);
    $currentUri = \Illuminate\Support\Facades\Route::getCurrentRoute()->getName();
?>

<div class="navigation_menu_list">
    @foreach($navigationMenu as $value)
        @php($selectedElements = in_array($currentUri, $value['tags']))
        @empty($value['url'])
            <input type="checkbox" id="nav_menu_list{{$loop->index}}" hidden {{$selectedElements ? 'checked' : ''}}>
            <label for="nav_menu_list{{$loop->index}}">
                <div class="navigation_menu_list_element {{$selectedElements ? 'navigation_menu_select_element_head' : ''}}">
                    <div class="navigation_menu_list_element_content">
                        <div class="navigation_menu_list_element_content_left">
                            <img class="navigation_menu_list_element_content_left_img" src="{{asset($selectedElements ? $value['icon_select'] : $value['icon'])}}">
                            @lang('nav_menu.'.$value['name'])
                        </div>
                        <img src="{{asset('img/navigation_menu_icon/icon_list'.($selectedElements ? '_select' : '').'.svg')}}">
                    </div>
                </div>
            </label>
            <div class="list">
                @foreach($value['elements'] as $element)
                    @php($selectElement = in_array($currentUri, $element['tags']))
                    <a href="{{$element['url']}}">
                        <div class="navigation_menu_list_element {{$selectElement ? 'navigation_menu_select_element' : ''}}">
                            <div class="navigation_menu_list_element_content">@lang('nav_menu.'.$element['name'])</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <a href="{{$value['url']}}">
                <div class="navigation_menu_list_element {{$selectedElements ? 'navigation_menu_select_element_head' : ''}}">
                    <div class="navigation_menu_list_element_content">
                        <div class="navigation_menu_list_element_content_left">
                            <img class="navigation_menu_list_element_content_left_img" src="{{asset($selectedElements ? $value['icon_select'] : $value['icon'])}}">
                            @lang('nav_menu.'.$value['name'])
                        </div>
                    </div>
                </div>
            </a>
        @endisset
    @endforeach
</div>

<div class="navigation_menu_console">
    <img class="navigation_menu_console_img" src="{{asset('img/navigation_menu_icon/icon_console.svg')}}" alt="icon_console">
    @lang('nav_menu.console')
</div>
