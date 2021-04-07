@push('css')
    <link rel="stylesheet" href="{{asset('css/context_menu.css')}}">
@endpush
<div class="context_menu">
    @foreach($contextMenuElements as $contextMenuElement)
        <a href="{{$contextMenuElement->url.$data}}" class="context_menu_element">
            <img class="context_menu_icon" src="{{$contextMenuElement->icon}}">
            <img class="context_menu_icon_select" src="{{$contextMenuElement->icon_select}}">
            {{$contextMenuElement->name}}
        </a>
    @endforeach
</div>
