@push('css')
    <link rel="stylesheet" href="{{asset('css/dialog.css')}}">
@endpush
@push('script')
@endpush

@once
    <div class="blk_scr_dlg"></div>
@endonce
<div class="crt_folder_dialog">
    @yield('dialog_content')
</div>
